<?php

namespace App\Http\Controllers;

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
    public function getIndex(Request $request) {
        $message = $request->input('message');
        if(empty($message)) return view('sticker.index');
        else return redirect()->route('sticker.index')->with('message', $message);
    }
    public function getCreate() {
        return view('sticker.create');
    }
    public function index()
    {
        $items = Item::all();
        return response()->json(['data' => $items]);
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
        if ($item == null) {
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
                    $newPath = $file->store('uploads/sticker/' . $id, 'public');
                    $item->update([
                        'path' => $newPath,
                    ]);
                } catch (Exception $e) {
                    return abort(500);
                }

            }
        $item->update([
            'name' => $data['name'],
            'price' => $data['price'],
        ]);

        return response()->json(['success'=> 'Item '.trim($item['name']).' 
        updated']);

    }

    public function store(StickerStoreRequest $request)
    {
        $data = $request->only(['name', 'price', 'image']);

        if ($request->hasFile('image')) {
            try {
                $file = $request->file('image');
                $path = $file->store('uploads/sticker/' . $data['name'], 'public');

            } catch (Exception $e) {
                return abort(500);
            }
           $item =  Item::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'path' => $path,
            ]);
            return response()->json(['success'=> 'Item '.$item['name'].' 
        added']);

        }
        return response()->json(['failed'=> 'Image file not found!']);
    }
}
