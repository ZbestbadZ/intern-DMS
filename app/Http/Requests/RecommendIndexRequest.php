<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecommendIndexRequest extends FormRequest
{

    protected $sortable = [
        '0' => 'id',
        '1' => 'name',
        '2' => 'birthday',
        '3' => 'phone',
        '4' => 'job',
        '5' => 'email',
        '6' => 'sex',
        '7' => 'birthday'
    ];
    protected $searchable = [
        '1' => 'name',
        '2' => 'age',
        '3' => 'phone',
        '4' => 'job',
        '6' => 'sex'
    ];

    public function getOrderByParameters()
    {
        $sort = [];
        $order = $this->input('order', []);
        if (count($order) > 0) {
            $sort = array($this->sortable[$order[0]['column']] => $order[0]['dir']);
        }
        return $sort;
    }

    public function getFilter()
    {
        $filters = array();
        foreach($this->searchable as $colIndex=>$colName) {
            $filter = $this->input('columns.'.$colIndex.'.search.value',null);
            $filters[$colName] = $filter;
        }
        return $filters;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
