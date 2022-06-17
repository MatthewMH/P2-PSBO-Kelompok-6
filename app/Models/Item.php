<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    private $item_name;
    private $price;
    private $count;

    public function __construct()
    {
        $item_name = "";
        $price = 0;
        $count = 0;
    }

    public function set_item_name($item_name)
    {
        $this->item_name = $item_name;
    }
    
    public function set_price($price)
    {
        $this->price = $price;
    }
    
    public function set_count($count)
    {
        $this->count = $count;
    }

    public function get_item_name()
    {
        return $this->item_name;
    }

    public function get_price()
    {
        return $this->price;
    }

    public function get_count()
    {
        return $this->count;
    }
}
