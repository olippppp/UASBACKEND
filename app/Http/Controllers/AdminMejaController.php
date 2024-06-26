<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;
use App\Rules\UniqueKodeMejaForUpdate;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminMejaController extends Controller
{
    //index
    public function index(Request $request)
    {
        $query = Meja::query();

        if ($request->has('cari')) {
            $keyword = $request->cari;
            $query->where(function ($query) use ($keyword) {
                $query->where('no_meja', 'like', '%' . $keyword . '%')
                    ->orWhere('kode', 'like', '%' . $keyword . '%');;
            });
        }

        $meja = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.meja.index', compact('meja'));
    }

    //create
    public function create()
    {
        return view('admin.meja.create');
    }

    //store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_meja' => 'required',
            'kode' => 'required|unique:meja,kode'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        $meja = new Meja();
        $meja->no_meja = $request->no_meja;
        $meja->kode = $request->kode;
        $meja->save();

        return redirect()->route('admin.meja')->with('success', 'Nomor Meja berhasil ditambah.');
    }

    //edit
    public function edit($id)
    {
        $meja = Meja::find($id);
        return view('admin.meja.edit', compact('meja'));
    }

    //update
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'no_meja' => 'required',
            'kode' => 'required|unique:meja,kode',
            'kode' => [
                'required',
                new UniqueKodeMejaForUpdate($id), // Pass the user ID to the rule
            ]
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $update = [
            'no_meja' => $request->no_meja,
            'kode' => $request->kode
        ];

        Meja::whereId($id)->update($update);

        return redirect()->route('admin.meja')->with('success', 'Nomor Meja berhasil diubah.');
    }

    //destroy
    public function destroy($id)
    {
        $meja = Meja::find($id);
        $meja->delete();

        return redirect()->route('admin.meja')->with('success', 'Nomor Meja berhasil dihapus.');
    }

    public function generateQrCode($id)
    {
        // Fetch data or validate $id as needed
        $meja = Meja::findOrFail($id);
        // Generate QR code using QrCode facade
        $baseUrl = URL::to('/');
        $qrCode = QrCode::size(300)->generate($baseUrl);
        // Build the HTML response
        $html = '<div style="font-size: 28px; text-align: center; margin: 20px 0;">Kode Meja: <b>' . $meja->kode . '</b></div>';
        $html .= '<div style="text-align: center;">' . $qrCode . '</div>';
        

        // Return the response
        return \Illuminate\Support\Facades\Response::make($html);
    }
}
