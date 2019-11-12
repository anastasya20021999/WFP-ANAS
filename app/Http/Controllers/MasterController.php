<?php

namespace App\Http\Controllers;

use App\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$dataMaster=Master::all();
        $dataMaster=Master::where('user_id',Auth::user()->id)->get();
        return view('master.index', [
            'hasilMaster'=>$dataMaster,
            'user_id'=>Auth::user()->id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.create');
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
         'nama_master'=>'required',
           'jenis_master'=>'required'
        ]);

        $namaMaster=$request->get('nama_master');
        $jenisMaster=$request->get('jenis_master');

        $master = new Master();
        $master->nama=$namaMaster;
        $master->jenis=$jenisMaster;
        $master->timestamps = false;
        $master->user_id=$request->get('user');
        $master->save();

        return redirect()->route('masters.index')->with('pesan','selamat anda berhasil menambahkan master baru dengan nama '.$namaMaster);
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
        $master = Master::find($id);
        return view('master.edit',['master'=>$master]);
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
        $master = Master::whereId($id)->firstOrFail();
        //set data dari field form ke objek kategori
        $master->nama = $request->get('nama_master');
        $master->jenis = $request->get('jenis_master');
        $master->timestamps = false;
        $master->save();
        // return redirect()->route('masters.index',['user_id' => $request->get('user')])->with('pesan','data master dengan nama '.$request->get('nama_master').' telah berhasil diubah');
        return redirect()->route('masters.index',['user_id' => $request->get('user')])->with('pesan','selamat anda berhasil merubah master dengan nama '. $request->get('nama_master'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $master = Master::find($id);
        $master->user_id=$request->get('user');
        $nama = $master->nama;
        $master->delete();
        return redirect()->route('masters.index',['user_id' => $request->get('user')])->with('pesan','data master dengan nama '.$nama.' sudah berhasil dihapus');
    }
}
