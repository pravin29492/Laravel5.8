<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RelationShip extends Controller
{
    public function index()
    {
        echo 'Relationship';
        return User::find(1)->details;

    }
}
