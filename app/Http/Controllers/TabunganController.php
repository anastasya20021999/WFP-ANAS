<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tabungan;
use Illuminate\Support\Facades\Auth;

class TabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabungans=Tabungan::retrieve(Auth::user()->id);
        return view('tabungan.index',[
        'tabungan'=>$tabungans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tabungan.create');
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
         'nama'=>'required',
           'target'=>'required'
        ]);

        Tabungan::input($request->get('nama'),0,$request->get('target'), Auth::user()->id);
        return redirect()->route('tabungans.index')->with('pesan','selamat berhasil input tabungan '.$request->get('nama')); 
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
        $tabungan = Tabungan::find($id);
        return view('tabungan.edit',['tabungan'=>$tabungan]);
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
        $this->validate($request,[
         'nama'=>'required',
           'target'=>'required'
        ]);

        $hasil=Tabungan::update($request->get('nama'),0,$request->get('target'), Auth::user()->id);
        
        return redirect()->route('tabungans.index')->with('pesan',$hasil); 
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
