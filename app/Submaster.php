<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submaster extends Model
{
 	public function transaksis()
 	{
 		//merelasikan ke barang
 		return $this->hasMany('App\Transaksi');
 	}
 	public function master()
    {
    	//kategori tanpa s karena dia single
    	return $this->belongsTo('App\Master');
    }
}
