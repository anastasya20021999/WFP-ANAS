<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


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
        $current_date_time = Carbon::now()->toDateTimeString();
        $tabungan->created_at=$current_date_time;
        $tabungan->updated_at=$current_date_time;
        $tabungan->save();
    } 
    public static function updateTabungan($nama, $nominal, $target, $userid)
    {
        $tabungan=self::whereId($userid)->firstOrFail();
        $hasil=$tabungan->nominal+$target;
        if($tabungan->status=1)
        {
            return "sudah tercapai tabungannya";
        }
        else
        {
            if($hasil>$tabungan->target){
                $tabungan->nama=$nama;
                $tabungan->nominal=$nominal;
                $tabungan->target=$target;
                $tabungan->user_id=$userid;
                $tabungan->status=1;
                $tabungan->timestamps = false;
                $tabungan->save();
                return "sudah tercapai tapi lebih ".($hasil-$tabungan->target);
            }
            else{
            //->nama kolom di db= objek yg suda dibuat
                $tabungan->nama=$nama;
                $tabungan->nominal=$nominal;
                $tabungan->target=$target;
                $tabungan->user_id=$userid;
                $tabungan->status=0;
                $tabungan->timestamps = false;
                $tabungan->save();
                return "berhasil update";
            }
        }
    }
} 

