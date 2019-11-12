<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
 	public function master()
    {
    	//kategori tanpa s karena dia single
    	return $this->belongsTo('App\Master');
    }
    public function submaster()
    {
    	//kategori tanpa s karena dia single
    	return $this->belongsTo('App\Submaster');
    }
    public function saldo()
    {
    	//kategori tanpa s karena dia single
    	return $this->belongsTo('App\Saldo');
    }
    public function tabungan()
    {
    	//kategori tanpa s karena dia single
    	return $this->belongsTo('App\Tabungan');
    }
    public function user()
    {
    	//kategori tanpa s karena dia single
    	return $this->belongsTo('App\User');
    }
}
