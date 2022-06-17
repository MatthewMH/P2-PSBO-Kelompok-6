<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reviews extends Model
{
    private $id_buyer;
    private $id_item;
    private $id_seller;
    private $review;

    public function __construct()
    {
        $id_buyer = "";
        $review = "";
    }

    public function set_id_buyer($id_buyer)
    {
        $this->id_buyer = $id_buyer;
    }

    public function set_id_item($id_item)
    {
        $this->id_item = $id_item;
    }

    public function set_id_seller($id_seller)
    {
        $this->id_seller = $id_seller;
    }

    public function set_review($review)
    {
        $this->review = $review;
    }

    public function get_id_buyer()
    {
        return $id_buyer;
    }

    public function get_id_item()
    {
        return $id_item;
    }

    public function get_id_seller()
    {
        return $id_seller;
    }

    public function get_review()
    {
        return $review;
    }

    public function insert_to_db()
    {
        DB::table('reviews')->insert([
            'idbuyer' => $this->id_buyer,
            'iditem' => $this->id_item,
            'idseller' => $this->id_seller,
            'review' => $this->review
        ]);
    }
}
