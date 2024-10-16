<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Ambil user yang sedang login
        $userData = $user->userData;

        return view('user.home', [
            "userData" => $userData,
        ]);
    }
}
