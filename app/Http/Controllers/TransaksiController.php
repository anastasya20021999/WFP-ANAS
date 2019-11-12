<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Saldo;
use App\Master;
use DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //$username=$request->get('username');

        $dataSaldo=Saldo::where('user_id',Auth::user()->id)->get();
        $dataMaster=Master::where('user_id',Auth::user()->id)->get();
        $dataTransaksi=Transaksi::where('user_id',Auth::user()->id)->get();
        //$nama=Kategori::where('nama','like','M%')->get();
        return view('transaksi.index', [
            'hasilTransaksi'=>$dataTransaksi,
            'hasilMaster'=>$dataMaster,
            'hasilSaldo'=>$dataSaldo,
           // 'username'=>$username, 
            'user_id'=>Auth::user()->id
            //hasil kategori nama var yang akan dikenal di view
        ]);
    }
    public function laporan()
    {
         //$username=$request->get('username');

        $dataSaldo=Saldo::where('user_id',Auth::user()->id)->get();
        $dataMaster=Master::where('user_id',Auth::user()->id)->get();
        $dataTransaksi=Transaksi::where('user_id',Auth::user()->id)->get();
        //$nama=Kategori::where('nama','like','M%')->get();
        return view('transaksi.index', [
            'hasilTransaksi'=>$dataTransaksi,
            'hasilMaster'=>$dataMaster,
            'hasilSaldo'=>$dataSaldo,
           // 'username'=>$username, 
            'user_id'=>Auth::user()->id
            //hasil kategori nama var yang akan dikenal di view
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataSaldo=Saldo::where('user_id',Auth::user()->id)->get();
        $dataMaster=Master::where('user_id',Auth::user()->id)->get();
        return view('transaksi.create',[
            'hasilMaster'=>$dataMaster,
            'hasilSaldo'=>$dataSaldo
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jumlah=$request->get('jumlah');
        $keterangan=$request->get('keterangan_transaksi');
        $namaSaldo=$request->get('jenis_saldo');
        $namaMaster=$request->get('jenis_master');

        $uploadedFile=$request->file('image');
        $tujuanupload = 'data_file';
        //$path=$uploadedFile->store('public/files');

        $uploadedFile->move($tujuanupload,$uploadedFile->getClientOriginalName());

        $dataSaldo=Saldo::where('id',$namaSaldo)->get();
        $nominal = $dataSaldo[0]->nominal-$jumlah;
        $saldo = Saldo::whereId($namaSaldo)->firstOrFail();
        //set data dari field form ke objek kategori
        $saldo->nominal = $nominal;
        $saldo->timestamps = false;
        $saldo->save();

        $dataMaster=Master::where('id',$namaMaster)->get();
        

        $dataSaldo->update =([ //updateing to myroutes table
        'nominal' => $nominal
        ]); 

        $transaksi=new Transaksi();
        //->nama kolom di db= objek yg suda dibuat
        $transaksi->jumlah=$jumlah;
        $transaksi->keterangan=$keterangan;
        $transaksi->master_id=$namaMaster;
        $transaksi->saldo_id=$namaSaldo;
        $transaksi->nama_gambar=$request->title ?? $uploadedFile->getClientOriginalName();
        $transaksi->user_id=Auth::user()->id;
        $transaksi->timestamps = false;
        $transaksi->save();

        return redirect()->route('transaksis.index')->with('pesan','selamat berhasil input transaksi '); //balek lagi ke halaman ini
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
