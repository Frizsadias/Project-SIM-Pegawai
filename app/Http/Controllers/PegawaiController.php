<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $users = Pegawai::with('user')->get();

        return view('pegawai.index', compact('users'));
    }

    public function create()
    {
        $userList = User::all();

        return view('pegawai.create', compact('userList'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'user_id' => 'required|unique:pegawai,user_id',
        ]);

        $data = $request->all();

        Pegawai::create($data);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai created successfully.');
    }

    public function edit($id)
    {
        $userList = User::all();
        $pegawai = Pegawai::where('user_id', $id)->first();

        return view('pegawai.edit', compact('userList', 'pegawai'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $data = $request->all();

        $pegawai = Pegawai::where('user_id', $id)->first();
        $pegawai->update($data);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai updated successfully.');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::where('user_id', $id)->first();
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai deleted successfully.');
    }
}
