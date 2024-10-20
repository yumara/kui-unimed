<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\IBMA;
use App\Models\IbmaLog;
use App\Http\Requests\User\IbmaRequest;
use App\Http\Requests\User\IbmaUploadRequest;
use Carbon\Carbon;

class IBMAController extends Controller
{
    public function index() {
        $user = auth()->user(); // Ambil user yang sedang login
        $userData = $user->userData;
        $ibmas = IBMA::where("user_id",$user->id)->get();

        return view('user.ibma.index', [
            "userData" => $userData,
            "ibmas" => $ibmas,
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
            $date_start = Carbon::createFromFormat('Y-m-d',  $form['date_start'])->format('Y-m-d');
            $date_end = Carbon::createFromFormat('Y-m-d',  $form['date_end'])->format('Y-m-d');

            $fields = [
                "user_id" => auth()->user()->id,
                "study_program" => $form['study_program'],
                "date_start" => $date_start,
                "date_end" => $date_end,
                "sponsor" => isset($form['sponsor']),
                "status" => "Mengupload File",
            ];
            IBMA::create($fields);
            return redirect()->route('user.ibma')->with('message', 'Berhasil Tambah Pengajuan. Silahkan Upload berkas yang diperlukan');
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    public function updateForm(int $id){
        $user = auth()->user(); // Ambil user yang sedang login
        $userData = $user->userData;
        $ibma = IBMA::findOrFail($id);

        return view('user.ibma.update', [
            "userData" => $userData,
            "ibma" => $ibma,
        ]);
    }

    public function update(IbmaRequest $request, int $id) : RedirectResponse {
        try {
            $form = $request->validated();
            $date_start = Carbon::createFromFormat('Y-m-d',  $form['date_start'])->format('Y-m-d');
            $date_end = Carbon::createFromFormat('Y-m-d',  $form['date_end'])->format('Y-m-d');

            $fields = [
                "study_program" => $form['study_program'],
                "date_start" => $date_start,
                "date_end" => $date_end,
                "sponsor" => isset($form['sponsor']),
            ];
            IBMA::findOrFail($id)->update($fields);
            return redirect()->route('user.ibma')->with('message', 'Berhasil Perbarui Pengajuan.');
        } catch (ValidationException $e) {
            throw $e;
        }
    }
    public function destroy(int $id)
    {
        IBMA::findOrFail($id)->delete();
        return redirect()->route('user.ibma')->with('message', 'Berhasil Hapus Pengajuan.');
    }
    public function uploadForm(int $id) {
        $user = auth()->user(); // Ambil user yang sedang login
        $userData = $user->userData;
        $ibma = IBMA::findOrFail($id);

        return view('user.ibma.upload', [
            "userData" => $userData,
            "ibma" => $ibma,
        ]);
    }
    public function upload(IbmaUploadRequest $request, int $id): RedirectResponse{//
        try {
            $form = $request->validated();
            $path = $request->file('file')->store('uploads/ibma/' .$form['field'].'/'. $id);
            $fields = [
                $form['field'] => $path,
            ];
            $ibma = IBMA::findOrFail($id)->update($fields);
            return redirect()->route('user.ibma.upload',$id)->with('message', 'Berhasil Upload File.');
            //return Response::make("Sukses", 200);
            //return response()->json(['message' => 'File uploaded successfully!', 'path' => $path], 200);
        } catch (ValidationException $e) {
            throw $e;
        }
       // return response()->json(['message' => 'File upload failed!'], 500);
    }
}
