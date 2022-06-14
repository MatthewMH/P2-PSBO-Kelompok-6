<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\UserFactory;
use App\Models\Item;

class Buyer implements User_activity
{
    public function signup($email, $username, $password, $location, $contact)
    {
        DB::table('buyers')->insert([
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
        $users = DB::select('select * from buyers where username = ? and password = ?', [$username, $password]);
        return $users;
    }

    public function buy_item()
    {

    }

    public function save_item()
    {

    }

    public function show_save_item()
    {

    }

    public function delete_save_item()
    {

    }

    public function buying_history()
    {

    }

    public function review_item()
    {

    }

    public function add_amount($username, $amount)
    {
        $id_buyer = collect(DB::select('select id from buyers where username = ?', [$username]))->pluck('id');
        $amount_prev = collect(DB::select('select amount from buyers where id = ?', [$id_buyer[0]]))->pluck('amount');
        $affected = DB::table('buyers')->where('id', $id_buyer[0])->update(['amount' => $amount_prev[0] + $amount]);
    }
}
