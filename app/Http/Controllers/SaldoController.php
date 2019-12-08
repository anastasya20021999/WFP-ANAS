<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Saldo;
use Illuminate\Support\Facades\Auth;

class SaldoController extends Controller
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
        //$nama=Kategori::where('nama','like','M%')->get();
        return view('saldo.index', [
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
        return view('saldo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
         'nama_saldo'=>'required',
           'nominal'=>'required'
        ]);

        $namaSaldo=$request->get('nama_saldo');
        $nominal=$request->get('nominal');

        $saldo=new Saldo();
        //->nama kolom di db= objek yg suda dibuat
        $saldo->nama=$namaSaldo;
        $saldo->nominal=$nominal;
        $saldo->user_id=$request->get('user');
        $saldo->timestamps = false;
        $saldo->save();

        return redirect()->route('saldos.index')->with('pesan','selamat berhasil input saldo '.$namaSaldo); //balek lagi ke halaman ini
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saldo = Saldo::find($id);
        return view('saldo.edit',['saldo'=>$saldo]);

        
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
        // $jumlah=$request->get('jumlah');
        // // $nama=$request->get

        // $dataSaldo=Saldo::where('id',$nama)->get();
        // $nominal = $dataSaldo[0]->nominal+$jumlah;

        $saldo = Saldo::whereId($id)->firstOrFail();
        $saldo->nama = $request->get('namaSaldo');
        $saldo->nominal = $request->get('nominal');
        $saldo->timestamps =false;
        $saldo->save();
        return redirect()->route('saldos.index',['user_id' => $request->get('user')])->with('pesan','selamat anda berhasil merubah saldo dengan nama '. $request->get('namaSaldo'));
    }

    // public function sum()
    // {
    //     $saldo = hitungTotalSaldo(Auth::user()->id);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $saldo = Saldo::find($id);
        $saldo->user_id=$request->get('user');
        $nama = $saldo->nama;
        $saldo->delete();
        return redirect()->route('saldos.index',['user_id' => $request->get('user')])->with('pesan','data saldo dengan nama '.$nama.' sudah berhasil dihapus');
    }
}
