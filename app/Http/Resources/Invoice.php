<?php
/**
 * Created by PhpStorm.
 * User: ciscomen
 * Date: 18/12/2018
 * Time: 22:03
 */

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\Resource;

class Invoice extends Resource
{
    public function toArray($request)
    {


        return [
            'id' => $this->id,
            'state' => $this->state,
            'meal_id' => $this->meal_id,
            'nif' => $this->nif,
            'name' => $this->name,
            'date' => $this->date,
            'total_price' => $this->total_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'table_number' => $this->meal->table_number,
            'responsible_waiter' => $this->meal->responsible_waiter->name
        ];
    }
}