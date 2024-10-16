<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\IBMA;
use App\Http\Requests\User\IbmaRequest;

class IBMAController extends Controller
{
    public function index() {
        $user = auth()->user(); // Ambil user yang sedang login
        $userData = $user->userData;

        return view('user.ibma.index', [
            "userData" => $userData,
        ]);
    }

    public function createForm(){
        $user = auth()->user(); // Ambil user yang sedang login
        $userData = $user->userData;

        return view('user.ibma.create', [
            "userData" => $userData,
        ]);
    }

    public function store(IbmaRequest $request) : RedirectResponse {
        try {
            $form = $request->validated();

            return redirect()->route('user.ibma.index')->with('message', 'Berhasil Perbarui Data');
        } catch (ValidationException $e) {
            throw $e;
        }
    }

}
