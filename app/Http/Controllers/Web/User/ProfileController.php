<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Account\UserDataRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use App\Models\UserData;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Ambil user yang sedang login
        $userData = $user->userData;
        return view('global.profile', [
            "userData" => $userData,
        ]);
    }
    public function update(UserDataRequest $request, string $id) : RedirectResponse {
        try {
            $form = $request->validated();
            $fields = [
                "gender" => $form['gender'],
                "place_birth" => $form['place_birth'],
                "date_birth" => $form['date_birth'],
                "phone_number" => $form['phone_number'],
                "address" => $form['address'],
                "city" => $form['city'],
                "country" => $form['country'],
                "citizenship" => $form['citizenship'],
                "occupation" => $form['occupation'],
                "passport_id" => $form['passport_id'],
                "study_program" => $form['study_program'],
            ];

            UserData::where('user_id',$id)->update($fields);

            return redirect()->route('user.profile')->with('message', 'Berhasil Perbarui Data');
        } catch (ValidationException $e) {
            throw $e;
        }
    }
}
