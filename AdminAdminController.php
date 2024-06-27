<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\UniqueEmailForUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminAdminController extends Controller
{
    //index
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('cari')) {
            $keyword = $request->cari;
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');;
            });
        }

        $admin = $query->orderBy('name', 'desc')->paginate(10);


        return view('admin.admin.index', compact('admin'));
    }

    //create
    public function create()
    {
        return view('admin.admin.create');
    }

    //store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.admin')->with('success', 'Admin berhasil ditambah.');
    }

    //edit
    public function edit($id)
    {
        $admin = User::find($id);
        return view('admin.admin.edit', compact('admin'));
    }

    //update
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                new UniqueEmailForUpdate($id), // check apakah email yang diubah sama dengan email user saat ini
            ],
            'password' => 'nullable|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $update = [
            'name' => $request->name,
            'email' => $request->email
        ];

        if ($request->password) {
            $update['password'] = Hash::make($request->password);
        }

        User::whereId($id)->update($update);

        return redirect()->route('admin.admin')->with('success', 'Admin berhasil diubah.');
    }

    //destroy
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.admin')->with('success', 'Admin berhasil dihapus.');
    }
}
