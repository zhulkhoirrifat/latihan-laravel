<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MahasiswaController extends Controller
{
    public function index(){
        $mahasiswa = Mahasiswa::latest()->get();
        return Inertia::render('mahasiswa/Index', compact('mahasiswa'));
    }

    public function create(){
        return Inertia::render('mahasiswa/Create', []);
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|numeric|min:0',
            'email' => 'required|string|max:255',
        ]);

        Mahasiswa::create($data);

        return redirect()->route('mahasiswa.index')->with('message', 'Mahasiswa berhasil ditambahkan');
    }

    public function edit(Mahasiswa $mahasiswa){
        return Inertia::render('mahasiswa/Edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa){
        $request->validate(([
            'name' => 'required|string|max:255',
            'nim' => 'required|numeric|min:0',
            'email' => 'required|string|max:255',
        ]));

        $mahasiswa->update([
            'name' => $request->input('name'),
            'nim' => $request->input('nim'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('mahasiswa.index')->with('message', 'Mahasiswa berhasil diubah');
    }   

    public function destroy(Mahasiswa $mahasiswa){
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('message', 'Mahasiswa berhasil dihapus');
    }
}
