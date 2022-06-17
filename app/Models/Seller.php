<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\UserFactory;
use App\Models\Item;

class Seller implements User_activity
{
    public function signup($email, $username, $password, $location, $contact)
    {
        DB::table('sellers')->insert([
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'location' => $location,
            'contact' => $contact,
            'amount' => 0
        ]);
    }

    public function login($username, $password)
    {
        $users = DB::select('select * from sellers where username = ? and password = ?', [$username, $password]);
        return $users;
    }

    public function add_item($username, $item_name, $price, $count)
    {
        $id_seller = collect(DB::select('select id from sellers where username = ?', [$username]))->pluck('id');
        $item = new Item();
        $item->set_item_name($item_name);
        $item->set_price($price);
        $item->set_count($count);
        $select = DB::select('select * from items where item_name = ? and idseller = ?', [$item->get_item_name(), $id_seller[0]]);

        if(!$select)
        {
            DB::table('items')->insert([
                'idseller' => $id_seller[0],
                'item_name' => $item->get_item_name(),
                'price' => $item->get_price(),
                'count' => $item->get_count()
            ]);
        }
        else
        {
            $count_prev = collect(DB::select('select count from items where item_name = ? and idseller = ?', [$item->get_item_name(), $id_seller[0]]))->pluck('count');
            $affected = DB::table('items')->where('idseller', $id_seller[0])->where('item_name', $item->get_item_name())->update(['count' => $count_prev[0] + $count]);
        }
    }

    public function show_item($username)
    {
        $id_seller = collect(DB::select('select id from sellers where username = ?', [$username]))->pluck('id');
        $item = collect(DB::select('select * from items where idseller = ?', [$id_seller[0]]));

        if((int)$item->isEmpty())
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }

    public function delete_item($username, $item_name, $count)
    {
        $id_seller = collect(DB::select('select id from sellers where username = ?', [$username]))->pluck('id');
        $count_prev = collect(DB::select('select count from items where idseller = ? and item_name = ?', [$id_seller[0], $item_name]))->pluck('count');
        
        if($count_prev[0] < $count)
        {
            return 0;
        }
        else
        {
            if($count_prev[0] == $count)
            {
                $deleted = DB::table('items')->where('item_name', $item_name)->where('idseller', $id_seller[0])->delete();
                return 1;
            }
            else
            {
                $deleted = DB::table('items')->where('idseller', $id_seller[0])->where('item_name', $item_name)->update(['count' => $count_prev[0] - $count]);
                return 2;
            }
        }
    }

    public function selling_history($username)
    {
        $id_seller = collect(DB::select('select id from sellers where username = ?', [$username]))->pluck('id');
        $history = DB::select('select * from transactions where idseller = ?', [$id_seller[0]]);

        return $history;
    }

    public function transfer_amount($username, $amount)
    {
        $id_seller = collect(DB::select('select id from sellers where username = ?', [$username]))->pluck('id');
        $amount_prev = collect(DB::select('select amount from sellers where id = ?', [$id_seller[0]]))->pluck('amount');
        $affected = DB::table('sellers')->where('id', $id_seller[0])->update(['amount' => $amount_prev[0] - $amount]);
    }
}
