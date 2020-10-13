<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $fillable = [
        'name', 'price', 'path',
    ];

    public static function getAllItems($filter, $orderParams, $start)
    {
        $searchName = $filter['name'];
        $searchPrice = $filter['price'];
        $orderBy = array_key_first($orderParams);
        $orderDir = $orderParams[$orderBy];

        $recordsFiltered = Item::select('id')->count();
        $items = Item::skip($start)->take(PAGINATION)->orderBy($orderBy, $orderDir);
        if (!is_null($searchName)) {
            $items->where('name', 'like', '%' . $searchName . '%');
        }

        if (!is_null($searchPrice)) {
            $items->where('price', 'like', '%' . $searchPrice . '%');
        }

        $items = $items->get();
        return compact(['items', 'recordsFiltered']);
    }

}
