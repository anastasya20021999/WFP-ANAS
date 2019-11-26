<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
 	public function transaksis()
 	{
 		//merelasikan ke barang
 		return $this->hasMany('App\Transaksi');
 	}
 	public function user()
    {
    	//kategori tanpa s karena dia single
    	return $this->belongsTo('App\User');
    }
    public static function retrieve($userid=1)
 	{
 		//manggil class pelanggan dari dlm class pelanggan pake self
 		$hasil=self::where('user_id','=',$userid)
 					->get();
 		return $hasil;
 	} 
 	public static function input($nama, $nominal, $target, $userid)
 	{
        $tabungan=new self();
        //->nama kolom di db= objek yg suda dibuat
        $tabungan->nama=$nama;
        $tabungan->nominal=$nominal;
        $tabungan->target=$target;
        $tabungan->user_id=$userid;
        $tabungan->status=0;
        $tabungan->timestamps = false;
        $tabungan->save();
 	} 
}
