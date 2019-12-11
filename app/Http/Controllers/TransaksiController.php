<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Saldo;
use App\Master;
use App\Tabungan;
use DB;
use Carbon\Carbon;
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
        return view('laporan.index', [
            'hasilTransaksi'=>$dataTransaksi,
            'hasilMaster'=>$dataMaster,
            'hasilSaldo'=>$dataSaldo,
           // 'username'=>$username, 
            'user_id'=>Auth::user()->id
            //hasil kategori nama var yang akan dikenal di view
        ]);
    }
    public function tampil(Request $request)
    {
        $tanggalAwal=$request->get('tanggal_awal');
        $tanggalAkhir=$request->get('tanggal_akhir');

        $dataTransaksi=Transaksi::where('user_id',Auth::user()->id)
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->get();
            $dataSaldo=Saldo::where('user_id',Auth::user()->id)->get();
        $dataMaster=Master::where('user_id',Auth::user()->id)->get();

        return view('laporan.tampil', [
            'hasilTransaksi'=>$dataTransaksi,
            'hasilMaster'=>$dataMaster,
            'hasilSaldo'=>$dataSaldo,
           // 'username'=>$username, 
            'user_id'=>Auth::user()->id
            //hasil kategori nama var yang akan dikenal di view
        ]);
    }
    

    //INI BUAT CHART!!!!!!!!!!!!
    // public function hitung()
    // {       
    //     $quantity = DB::table('transaksis')
    //                         ->select * DB::raw('SUM(jumlah) as quantity')
    //                         ->join('masters', 'transaksis.master_id','=','masters.master_id')
    //                         ->groupBy('master_id')
    //                         ->get();
        
        
    //     return view('laporan/index', 
    //     ['quantity'=>$quantity, 
    //     'user_id'=>Auth::user()->id]);                    
    // }



    public function chartX(){
        // $master = Master::find($id);
        // $user = User::find($id);
        
        // $categories = [];

        // foreach($master as $ms)
        // {
        //     $categories[] = $ms->nama;
        // }
        return view ('laporan.index');
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
        //$dataTabungan=Tabungan::where('user_id',Auth::user()->id)->get();
        return view('transaksi.create',[
            'hasilMaster'=>$dataMaster,
            'hasilSaldo'=>$dataSaldo
           // 'hasilTabungan'=>$dataTabungan
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
        $namaSubmaster=$request->get('jenis_submaster');


        $uploadedFile=$request->file('image');
        $tujuanupload = 'data_file';
        //$path=$uploadedFile->store('public/files');

        $uploadedFile->move($tujuanupload,$uploadedFile->getClientOriginalName());
        $hasilMaster=Master::whereId($namaMaster)->firstOrFail();
            if ($hasilMaster->jenis=="pengeluaran") {
                $dataSaldo=Saldo::where('id',$namaSaldo)->get();
                $nominal = $dataSaldo[0]->nominal-$jumlah;
                $saldo = Saldo::whereId($namaSaldo)->firstOrFail();
                //set data dari field form ke objek kategori
                $saldo->nominal = $nominal;
                $saldo->timestamps = false;
                $saldo->save();

                $dataSaldo->update =([ //updateing to myroutes table
                'nominal' => $nominal
                ]); 
            }
            else
            {
                $dataSaldo=Saldo::where('id',$namaSaldo)->get();
                $nominal = $dataSaldo[0]->nominal+$jumlah;
                $saldo = Saldo::whereId($namaSaldo)->firstOrFail();
                //set data dari field form ke objek kategori
                $saldo->nominal = $nominal;
                $saldo->timestamps = false;
                $saldo->save();

                $dataSaldo->update =([ //updateing to myroutes table
                'nominal' => $nominal
                ]); 
            }
            $transaksi=new Transaksi();
            $transaksi->jumlah=$jumlah;
            $transaksi->keterangan=$keterangan;
            $transaksi->master_id=$namaMaster;
            $transaksi->saldo_id=$namaSaldo;
            $transaksi->nama_gambar=$request->title ?? $uploadedFile->getClientOriginalName();
            $transaksi->user_id=Auth::user()->id;
            $current_date_time = Carbon::now()->toDateTimeString();
            $transaksi->updated_at=$current_date_time;
            $transaksi->created_at = $current_date_time;
            if($namaSubmaster!="none"){
            $transaksi->submaster_id=$namaSubmaster;
            }
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










     public function grafikpemasukanpengeluaran(Request $request)
    {
         $pemasukkan = DB::table('transaksis as t')
        ->join('masters as m', 't.master_id','=', 'm.id')
        ->where('m.jenis', "Pemasukkan")
        ->where('t.user_id', Auth::User()->id)
        // ->whereBetween('created_at',[$request->tanggalawal, $request->tanggalakhir])
        ->sum('t.jumlah');


        $pengeluaran = DB::table('transaksis as t')
        ->join('masters as m', 't.master_id','=', 'm.id')
        ->where('m.jenis', "Pengeluaran")
        ->where('t.user_id', Auth::User()->id)
        // ->whereBetween('created_at',[$request->tanggalawal, $request->tanggalakhir])
        ->sum('t.jumlah');

        // dd($pengeluaran);

        $grafik[] = ['Jenis Transaksi', 'Nominal'];
        $grafik[1] = ["Pemasukkan", $pemasukkan];
        $grafik[2] = ["Pengeluaran", $pengeluaran];


        return view('laporan.rasiopemasukanpengeluaran')->with('grafik', json_encode($grafik));
    }

     public function grafikpemasukanpengeluaranfilter(Request $request)
    {

        $pemasukkan = DB::table('transaksis as t')
        ->join('masters as m', 't.master_id','=', 'm.id')
        ->where('m.jenis', "Pemasukkan")
        ->where('t.user_id', Auth::User()->id)
        ->whereBetween('created_at',[$request->tanggalawal, $request->tanggalakhir])
        ->sum('t.jumlah');


          $pengeluaran = DB::table('transaksis as t')
        ->join('masters as m', 't.master_id','=', 'm.id')
        ->where('m.jenis', "Pengeluaran")
        ->where('t.user_id', Auth::User()->id)
        ->whereBetween('created_at',[$request->tanggalawal, $request->tanggalakhir])
        ->sum('t.jumlah');



     $grafik[] = ['Jenis Transaksi', 'Nominal'];
        $grafik[1] = ["Pemasukkan", $pemasukkan];
        $grafik[2] = ["Pengeluaran", $pengeluaran];


        return view('laporan.rasiopemasukanpengeluaran')->with('grafik', json_encode($grafik));
    }

    public function trendpemasukan(Request $request)
    {   



        $pemasukkan = DB::table('transaksis as t')
        ->join('masters as m', 'm.id','=', 't.master_id')
        ->join('submasters as sm', 'sm.master_id', '=', 'm.id')
        ->select(DB::raw('sum(t.jumlah) as jumlah, m.nama as namamaster, sm.nama as namasubmaster'))
        ->where('t.user_id', Auth::User()->id)
        ->where('m.jenis', "Pemasukkan")
        ->groupBy('jumlah','namamaster','namasubmaster')
        ->get();

        $grafik[] = ['Nama Master dan Submaster', 'Nominal'];

        foreach($pemasukkan as $index => $p)
        {
            $grafik[++$index] = [$p->namamaster."--".$p->namasubmaster, $p->jumlah];
        }



         return view('laporan.trendpemasukan')->with('grafik', json_encode($grafik));

    }

    public function trendpemasukanfilter(Request $request)
    {
         $pemasukkan = DB::table('transaksis as t')
        ->join('masters as m', 'm.id','=', 't.master_id')
        ->join('submasters as sm', 'sm.master_id', '=', 'm.id')
        ->select(DB::raw('sum(t.jumlah) as jumlah, m.nama as namamaster, sm.nama as namasubmaster'))
        ->where('t.user_id', Auth::User()->id)
        ->where('m.jenis', "Pemasukkan")
       ->whereBetween('created_at',[$request->tanggalawal, $request->tanggalakhir])
        ->groupBy('jumlah','namamaster','namasubmaster')
        ->get();

        $grafik[] = ['Nama Master dan Submaster', 'Nominal'];

        foreach($pemasukkan as $index => $p)
        {
            $grafik[++$index] = [$p->namamaster."--".$p->namasubmaster, $p->jumlah];
        }



         return view('laporan.trendpemasukan')->with('grafik', json_encode($grafik));
    }



    public function trendpengeluaran(Request $request)
    {
        $pengeluaran = DB::table('transaksis as t')
        ->join('masters as m', 'm.id','=', 't.master_id')
        ->join('submasters as sm', 'sm.master_id', '=', 'm.id')
        ->select(DB::raw('sum(t.jumlah) as jumlah, m.nama as namamaster, sm.nama as namasubmaster'))
        ->where('t.user_id', Auth::User()->id)
        ->where('m.jenis', "Pengeluaran")
       // ->whereBetween('created_at',[$request->tanggalawal, $request->tanggalakhir])
        ->groupBy('jumlah','namamaster','namasubmaster')
        ->get();



        $grafik[] = ['Nama Master dan Submaster', 'Nominal'];

        foreach($pengeluaran as $index => $p)
        {
            $grafik[++$index] = [$p->namamaster."--".$p->namasubmaster, $p->jumlah];
        }



         return view('laporan.trendpengeluaran')->with('grafik', json_encode($grafik));
    }

    public function trendpengeluaranfilter(Request $request)
    {
                $pengeluaran = DB::table('transaksis as t')
        ->join('masters as m', 'm.id','=', 't.master_id')
        ->join('submasters as sm', 'sm.master_id', '=', 'm.id')
        ->select(DB::raw('sum(t.jumlah) as jumlah, m.nama as namamaster, sm.nama as namasubmaster'))
        ->where('t.user_id', Auth::User()->id)
        ->where('m.jenis', "Pengeluaran")
       ->whereBetween('created_at',[$request->tanggalawal, $request->tanggalakhir])
        ->groupBy('jumlah','namamaster','namasubmaster')
        ->get();

        $grafik[] = ['Nama Master dan Submaster', 'Nominal'];

        foreach($pengeluaran as $index => $p)
        {
            $grafik[++$index] = [$p->namamaster."--".$p->namasubmaster, $p->jumlah];
        }



         return view('laporan.trendpengeluaran')->with('grafik', json_encode($grafik));
    }





   

}
