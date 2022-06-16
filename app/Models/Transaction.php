<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    private $id_seller;
    private $id_buyer;
    private $id_item;
    private $price;
    private $count;
    private $total_price;

    public function __construct()
    {
        $id_seller = "";
        $id_buyer = "";
        $id_item = "";
        $price = 0;
        $count = 0;
        $total_price = 0;
    }

    public function set_id_seller($id_seller)
    {
        $this->id_seller = $id_seller;
    }

    public function set_id_buyer($id_buyer)
    {
        $this->id_buyer = $id_buyer;
    }

    public function set_id_item($id_item)
    {
        $this->id_item = $id_item;
    }

    public function set_price($price)
    {
        $this->price = $price;
    }

    public function set_count($count)
    {
        $this->count = $count;
    }

    public function set_total_price($total_price)
    {
        $this->total_price = $total_price;
    }

    public function get_id_seller()
    {
        return $id_seller;
    }

    public function get_id_buyer()
    {
        return $id_buyer;
    }

    public function get_id_item()
    {
        return $id_item;
    }

    public function get_price()
    {
        return $price;
    }

    public function get_count()
    {
        return $count;
    }

    public function get_total_price()
    {
        return $total_price;
    }

    public function insert_to_db()
    {
        DB::table('transactions')->insert([
            'idseller' => $this->id_seller,
            'idbuyer' => $this->id_buyer,
            'iditem' => $this->id_item,
            'price' => $this->price,
            'count' => $this->count,
            'total_price' => $this->total_price
        ]);
    }
}
