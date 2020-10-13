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
        $query = Item::orderBy($orderBy, $orderDir);
        $recordsFiltered = clone($query);
        $recordsFiltered = $recordsFiltered->select('id')->count();
        $items = $query->skip($start)->take(PAGINATION);
        if (!is_null($searchName)) {
            $items->where('name', 'like', '%' . $searchName . '%');
        }

        if (!is_null($searchPrice)) {
            $items->where('price', '=', $searchPrice);
        }

        $items = $items->get();
        return compact(['items', 'recordsFiltered']);
    }

}
