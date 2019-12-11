<?php

namespace App\Http\Controllers;

//use App\Submaster;
//use App\Master;
use Illuminate\Http\Request;
use DB;
use App\Master;
use App\Submaster;
use Illuminate\Support\Facades\Auth;

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
                ->where('user_id','=', Auth::user()->id)
                ->get();

        
        return view('submaster.tambah',compact('duar'));
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
         'nama_submaster'=>'required',
           'jenis_pembayaran'=>'required',
           'select_master'=>'required'
        ]);

         // $submaster = new Submaster([
         //    'nama'=>$request->get('nama_submaster'),
         //    'pembayaran'=>$request->get('jenis_pembayaran')]);
         // $master=Master::find($request->get('select_master'));
         // $master->submasters()->save($submaster);
        $namaSub = $request->get('nama_submaster');
        $jenisbayar=$request->get('jenis_pembayaran');
        $master_id=$request->get('select_master');
        $submaster = new Submaster();
        $submaster->nama=$namaSub;
        $submaster->pembayaran=$jenisbayar;
        $submaster->master_id=$master_id;
        $submaster->timestamps=false;
        $master=Master::find($request->get('select_master'));
        $master->submasters()->save($submaster);
        return redirect()->route('masters.index')->with('pesan','selamat anda berhasil menambahkan submaster baru dengan nama '.$namaSub);
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
        $submaster = Submaster::find($id);
        return view('submaster.edit',['submaster'=>$submaster]);
    }

    public function tampil(Request $request)
    {
        $submaster = Submaster::where('master_id', $request->get('id'))->get();
        echo $submaster;
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
        $submaster = Submaster::whereId($id)->firstOrFail();
        //set data dari field form ke objek kategori
        $submaster->nama = $request->get('nama_submaster');
        $submaster->pembayaran = $request->get('jenis_pembayaran');
        $submaster->timestamps = false;
        $submaster->save();
        
        return redirect()->route('masters.index',['user_id' => $request->get('user')])->with('pesan','selamat anda berhasil merubah submaster dengan nama '. $request->get('nama_master'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $submaster = Submaster::find($id);
        $nama_submaster = $submaster->nama;
        $submaster->delete();
        return redirect()->route('masters.index',['user_id' => $request->get('user')])->with('pesan','data submaster dengan nama '.$nama_submaster.' sudah berhasil dihapus');
    }
}
