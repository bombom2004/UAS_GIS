<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('backend.auth.login');
    }

    public function formUser()
    {
        return view('backend.auth.daftar');
    }

    public function datapengguna()
    {
        $pengguna = DB::table('users')->get();
        $nomor = 1;
        return view('backend.auth.index', compact('pengguna', 'nomor'));
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        };

        return back()->withErrors([
            'email' => 'Email tidak ditemukan',
            'password' => 'Password salah'
        ])->onlyInput('email', 'password');
    }

    public function editUser($id)
{
    // Ambil data pengguna berdasarkan ID
    $user = User::find($id);

    // Cek apakah data pengguna ditemukan
    if (!$user) {
        return redirect()->route('datapengguna')->with('error', 'Data tidak ditemukan.');
    }

    // Mengirimkan data pengguna ke view
    return view('backend.auth.daftar', compact('user'));
}

    
    public function updateUser(Request $request, $id)
    {
        // Validasi input
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', "unique:users,email,$id"],
            'password' => ['nullable', 'min:8', 'confirmed'],
        ]);
    
        // Update data pengguna
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
    
        // Jika password diubah, maka update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        return redirect()->route('datapengguna')->with('success', 'Pengguna berhasil diperbarui');
    }
    
    // public function simpan(Request $request)
    // {
    //     // Validasi input untuk pendaftaran
    //     $this->validate($request, [
    //         'email' => ['required', 'email', 'unique:users,email'],
    //         'password' => ['required', 'min:8', 'confirmed']
    //     ]);
    
    //     // Simpan pengguna baru
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);
    
    //     return redirect('dashboard');
    // }
    
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('datapengguna')->with('success', 'Pengguna berhasil dihapus');
    }
}