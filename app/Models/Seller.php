<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\UserFactory;
use App\Models\Item;

class Seller implements User_activity
{
    public function saves($email, $username, $password, $location, $contact)
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
        $item = new Item();
    }
}
