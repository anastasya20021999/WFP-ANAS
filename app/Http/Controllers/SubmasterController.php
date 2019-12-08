<?php

namespace App\Http\Controllers;

//use App\Submaster;
//use App\Master;
use Illuminate\Http\Request;
use DB;
use App\Master;
use App\Submaster;

class SubmasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $dataSubmaster=Submaster::all();
        // return view('master.index', [
        //     'hasilsub'=>$hasilsubmas
        // ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $duar = DB::table('masters')
                ->select('*')
                ->get();
        
        return view('submaster/tambah',compact('duar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama = $request->get('nama_submaster');
        $jenis_pembayaran = $request->get('jenis_pembayaran');
        $master_id = $request->get('select_master');

        $tambahsub = Submaster::insert([
            'nama' => $nama,
            'pembayaran' => $jenis_pembayaran,
            'master_id' => $master_id
        ]);

        return redirect()->back();
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
