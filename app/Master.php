<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    public function submasters()
 	{
 		//merelasikan ke barang
 		return $this->hasMany('App\Submaster');
 	}
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
