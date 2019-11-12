<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
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
}
