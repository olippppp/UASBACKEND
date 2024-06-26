<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\Rules\UniqueEmailForUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminCustomerController extends Controller
{
    //index
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->has('cari')) {
            $keyword = $request->cari;
            $query->where(function ($query) use ($keyword) {
                $query->where('nama', 'ilike', '%' . $keyword . '%')
                    ->orWhere('email', 'ilike', '%' . $keyword . '%');;
            });
        }

        $customer = $query->orderBy('nama', 'desc')->paginate(10);


        return view('admin.customer.index', compact('customer'));
    }

    //create
    public function create()
    {
        return view('admin.customer.create');
    }

    //store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:8',
            'no_hp' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('customers')->insert([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp
        ]);

        return redirect()->route('admin.customer')->with('success', 'Customer berhasil ditambah.');
    }

    //edit
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('admin.customer.edit', compact('customer'));
    }

    //update
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                new UniqueEmailForUpdate($id), // check apakah email yang diubah sama dengan email user saat ini
            ],
            'password' => 'nullable|min:8',
            'no_hp' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $update = [
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp
        ];

        if ($request->password) {
            $update['password'] = Hash::make($request->password);
        }

        Customer::whereId($id)->update($update);

        return redirect()->route('admin.customer')->with('success', 'Customer berhasil diubah.');
    }

    //destroy
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return redirect()->route('admin.customer')->with('success', 'Customer berhasil dihapus.');
    }
}
