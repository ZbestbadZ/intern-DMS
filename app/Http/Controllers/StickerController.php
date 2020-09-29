<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class StickerController extends Controller
{
    public function __construct()
    {
        
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
