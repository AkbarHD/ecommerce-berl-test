<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            if(Auth::user()->role == 1){
                return redirect()->route('homeadmin');
            }else{
                return redirect()->route('profile');
            }
        } else {
            return back()->withErrors(['errors' => 'Email atau password salah.'])->withInput();
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerProses(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'no_hp' => 'required|string|max:20',
                'gender' => 'required|in:male,female',
                'alamat' => 'required|string|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // Proses upload logo jika ada
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
                $destination = public_path('uploads/logo');

                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }

                $file->move($destination, $filename);
                $logoPath = 'uploads/logo/' . $filename;
            }

            // Simpan user
            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'gender' => $request->gender,
                'alamat' => $request->alamat,
                'logo' => $logoPath,
                'password' => Hash::make($request->password),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            Log::channel('daily')->info('Pendaftaran berhasil', [
                'email' => $request->email,
                'ip' => $request->ip(),
                'waktu' => now(),
            ]);

            return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::channel('daily')->error('Gagal mendaftar user', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'email' => $request->email ?? null
            ]);

            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat mendaftar.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
