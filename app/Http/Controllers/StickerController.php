<?php

namespace App\Http\Controllers;

use App\Http\Requests\StickerIndexRequest;
use App\Http\Requests\StickerStoreRequest;
use App\Http\Requests\StickerUpdateRequest;
use App\Models\Item;
use Exception;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StickerController extends Controller
{
    protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    public function getIndex(Request $request)
    {
        $message = $request->input('message');
        if (empty($message)) {
            return view('sticker.index');
        }
        return redirect()->route('sticker.index')->with('message', $message);
    }
    public function getCreate()
    {
        return view('sticker.create');
    }
    public function index(StickerIndexRequest $request)
    {
        $filter = $request->getFilter();
        $orderParams = $request->getOrderByParameters();
        $start = $request->input('start', 0);

        $itemsQuery = Item::getAllItems($filter, $orderParams, $start);
        $items = $itemsQuery['items'];
        $recordsFiltered = $itemsQuery['recordsFiltered'];
        $recordsTotal = Item::select('id')->count();

        return response()->json(['data' => $items, 'recordsFiltered' => $recordsFiltered, 'recordsTotal' => $recordsTotal]);
    }

    public function get(Request $request, $id)
    {

        $item = Item::find($id);
        if (empty($item)) {
            return abort(404);
        }

        return response()->json(['item' => $item]);
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        if (empty($item)) {
            return abort(404);
        }

        try {
            Storage::disk('public')->delete($item->path);
        } catch (Exception $e) {
            abort(404);
        }
        $item->delete();
        return response()->json(['item' => $item]);
    }

    public function edit($id)
    {
        $item = Item::find($id);
        if (empty($item)) {
            return abort(404);
        }

        return view('sticker.edit', compact('item'));
    }

    public function update(StickerUpdateRequest $request, $id)
    {

        $item = Item::find($id);
        if (empty($item)) {
            return abort(404);
        }

        $data = $request->only(['name', 'price', 'image']);

        if ($request->hasFile('image')) {
            try {
                Storage::disk('public')->delete($item->path);
                $file = $request->file('image');
                $fileName = uniqid() . "-" . $file->getClientOriginalName();
                $newPath = $file->storeAs('uploads/sticker/', $fileName, 'public');

                $data['path'] = $newPath;

            } catch (Exception $e) {
                return abort(500);
            }

        }
        $item->update($data);

        return response()->json(['success' => 'Item ' . trim($item['name']) . '
        updated', ]);

    }

    public function store(StickerStoreRequest $request)
    {
        $data = $request->only(['name', 'price', 'image']);
        if ($request->hasFile('image')) {
            try {
                $file = $request->file('image');
                $fileName = uniqid() . "-" . $file->getClientOriginalName();
                $newPath = $file->storeAs('uploads/sticker/', $fileName, 'public');

                $data['path'] = $newPath;
            } catch (Exception $e) {
                return abort(500);
            }
            $item = Item::create($data);
            return response()->json(['success' => 'Item ' . $item['name'] . '
        added', ]);

        }
        return response()->json(['failed' => 'Image file not found!']);
    }
}
