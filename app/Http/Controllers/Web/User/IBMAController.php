<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IBMA;

class IBMAController extends Controller
{
    function index() {
        $user = auth()->user(); // Ambil user yang sedang login
        $userData = $user->userData;

        return view('user.ibma.index', [
            "userData" => $userData,
        ]);
    }

}
