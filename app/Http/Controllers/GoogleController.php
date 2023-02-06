<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class GoogleController extends Controller
{
    public function index(){
        return view('profile');
    }
    
}
