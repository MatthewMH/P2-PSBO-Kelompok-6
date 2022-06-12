<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
use App\Models\Buyer;

interface User_activity
{
    public function signup($email, $username, $password, $location, $contact);
    public function login($username, $password);
}

class UserFactory extends Model
{
    public static function makeSeller(): User_activity
    {
        return new Seller();
    }

    public static function makeBuyer(): User_activity
    {
        return new Buyer();
    }
}
