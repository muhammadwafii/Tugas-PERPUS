<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Exception;

class UserController extends Controller
{
    public function index()
    { 
        $user = User::paginate(5);
        return view('user.index')->withuser($user);  
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|unique:users|min:5',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'hp' => 'required|min:9|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'role' => 'required',
            'name' => 'required'
        ]);
        
        try {
            $user = User::create([
                'userid' => Str::uuid(),
                'username' => $request->username,
                'name' => $request->name,
                'nama_lengkap' => $request->nama_lengkap,
                'alamat' => $request->alamat,
                'hp' => $request->hp,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            if ($user) {
                $role = new Role;
                $role->user_id = $user->id;
                $role->role = $request->role;
                $role->save();
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data Gagal Disimpan');
        }
    
        return redirect()->route('user.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User tidak ditemukan');
        }
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'username' => 'required|min:5|unique:users,username,' . $id,
            'name' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'hp' => 'required|min:9|numeric',
            'email' => 'required|string|unique:users,email,' . $id,
            'role' => 'required',
        ]);
          
        try {
            $user = User::find($id); 
            if (!$user) {
                return redirect()->back()->with('error', 'User tidak ditemukan');
            }

            $user->username = $request->username;
            $user->name = $request->name;
            $user->nama_lengkap = $request->nama_lengkap;
            $user->alamat = $request->alamat;
            $user->hp = $request->hp;
            $user->email = $request->email;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            $role = Role::firstOrNew(['user_id' => $id]);
            $role->role = $request->role;
            $role->save();

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data Gagal Disimpan');
        }

        return redirect()->route('user.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        try {
            Role::where('user_id', $id)->delete();
            $user->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'User Gagal dihapus');
        }
        return redirect()->route('user.index')->with('success', 'User Berhasil dihapus');
    }
}
