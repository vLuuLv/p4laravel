<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::all();
        $satu = rand(1, 9);
        $dua = rand(1, 9);
        return view('contact', [
            "title" => "Contact"
        ], compact('contact', 'satu', 'dua'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hasil = $request->satu + $request->dua;
        if ($request->captcha === strval($hasil)) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'email' => 'required',
                'pesan' => 'required',
            ], [
                'nama.required' => 'Nama tidak boleh kosong!',
                'email.required' => 'Email tidak boleh kosong!',
                'pesan.required' => 'Pesan tidak boleh kosong!',
            ]);
        } else {
            return back()->withErrors(['msg' => 'Captcha salah!']);
        }

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            DB::transaction(function () use ($request) {

                Contact::create([
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'pesan' => $request->pesan,
                ]);
            });


            return back()->with(['success' => 'Pesan berhasil disimpan!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
