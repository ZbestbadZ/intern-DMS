<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class StickerController extends Controller
{
    protected $auth;
    public function __construct(Guard $auth )
    {
        $this->auth = $auth;
    }

    public function index() {
        $items = Item::all();
        return response()->json(['data'=>$items]);
    }
    public function get(Request $request, $id) {

        $item = Item::find($id);
        return response()->json(['item'=>$item]);
    }
}
