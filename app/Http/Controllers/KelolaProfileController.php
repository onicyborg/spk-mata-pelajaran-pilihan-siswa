<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KelolaProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());

        if (Auth::user()->role == 'Guru') {
            return view('guru.profile', ['guru' => $user]);
        } else if (Auth::user()->role == 'Siswa') {
            return view('siswa.profile', ['siswa' => $user]);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        if ($user->role == 'Guru') {
            $request->validate(
                [
                    'name' => 'required',
                    'username' => 'required|unique:users,username,' . Auth::id(),
                    'gender' => 'required|in:Pria,Wanita',
                    'tempat_lahir' => 'required',
                    'tanggal_lahir' => 'required',
                ],
                [
                    'name.required' => 'Nama harus diisi.',
                    'username.required' => 'NIP harus diisi.',
                    'username.unique' => 'NIP sudah terdaftar.',
                    'gender.required' => 'Jenis kelamin harus dipilih.',
                    'gender.in' => 'Jenis kelamin harus Pria atau Wanita.',
                    'tempat_lahir.required' => 'Tempat lahir harus diisi.',
                    'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
                ]
            );

            $user->name = $request->name;
            $user->username = $request->username;

            if ($user->biodata != null) {
                $biodata = $user->biodata;

                $biodata->gender = $request->gender;
                $biodata->tempat_lahir = $request->tempat_lahir;
                $biodata->tanggal_lahir = $request->tanggal_lahir;
                if ($request->email != '') {
                    $biodata->email = $request->email;
                }
                if ($request->no_hp != '') {
                    $biodata->no_hp = $request->no_hp;
                }
                $biodata->save();
                $user->save();
            } else {
                $biodata = new Biodata();
                $biodata->user_id = Auth::id();
                $biodata->gender = $request->gender;
                $biodata->tempat_lahir = $request->tempat_lahir;
                $biodata->tanggal_lahir = $request->tanggal_lahir;
                if ($request->email != '') {
                    $biodata->email = $request->email;
                }
                if ($request->no_hp != '') {
                    $biodata->no_hp = $request->no_hp;
                }

                $biodata->save();
                $user->save();
            }

            return redirect()->back()->with('success', 'Berhasil Update Data');
        } else if ($user->role == 'Siswa') {
            $request->validate(
                [
                    'name' => 'required',
                    'username' => 'required|unique:users,username,' . Auth::id(),
                    'gender' => 'required|in:Pria,Wanita',
                    'tempat_lahir' => 'required',
                    'tanggal_lahir' => 'required',
                    'kelas' => 'required'
                ],
                [
                    'name.required' => 'Nama harus diisi.',
                    'username.required' => 'NIP harus diisi.',
                    'username.unique' => 'NIP sudah terdaftar.',
                    'gender.required' => 'Jenis kelamin harus dipilih.',
                    'gender.in' => 'Jenis kelamin harus Pria atau Wanita.',
                    'tempat_lahir.required' => 'Tempat lahir harus diisi.',
                    'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
                    'kelas.required' => 'Kelas harus diisi'
                ]
            );

            $user->name = $request->name;
            $user->username = $request->username;

            if ($user->biodata != null) {
                $biodata = $user->biodata;

                $biodata->gender = $request->gender;
                $biodata->tempat_lahir = $request->tempat_lahir;
                $biodata->tanggal_lahir = $request->tanggal_lahir;
                $biodata->kelas = $request->kelas;
                if ($request->email != '') {
                    $biodata->email = $request->email;
                }
                if ($request->no_hp != '') {
                    $biodata->no_hp = $request->no_hp;
                }
                $biodata->save();
                $user->save();
            } else {
                $biodata = new Biodata();
                $biodata->user_id = Auth::id();
                $biodata->gender = $request->gender;
                $biodata->tempat_lahir = $request->tempat_lahir;
                $biodata->tanggal_lahir = $request->tanggal_lahir;
                $biodata->kelas = $request->kelas;
                if ($request->email != '') {
                    $biodata->email = $request->email;
                }
                if ($request->no_hp != '') {
                    $biodata->no_hp = $request->no_hp;
                }

                $biodata->save();
                $user->save();
            }

            return redirect()->back()->with('success', 'Berhasil Update Data');
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function ubah_password(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed',
        ]);

        $user = User::find(Auth::id());

        if ($user->role == 'Guru') {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('success', 'Berhasil Ubah Password');
        } else if ($user->role == 'Siswa') {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('success', 'Berhasil Ubah Password');
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function avatar(Request $request)
    {
        $user = User::find(Auth::id());

        $avatar = $request->file('avatar');
        $avatar_name = Str::uuid() . '.' . $avatar->getClientOriginalExtension();
        $avatar->storeAs('profile', $avatar_name, 'public');
        $user->profile = $avatar_name;

        $user->save();

        return redirect()->back()->with('success', 'Berhasil Merubah Foto Profile');
    }
}
