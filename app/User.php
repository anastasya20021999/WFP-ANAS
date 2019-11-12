<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function masters()
    {
        //merelasikan ke master
        return $this->hasMany('App\Master');
    }
    public function saldos()
    {
        //merelasikan ke saldo
        return $this->hasMany('App\Saldo');
    }
    public function tabungans()
    {
        //merelasikan ke tabungan
        return $this->hasMany('App\Tabungan');
    }
    public function transaksis()
    {
        //merelasikan ke tabungan
        return $this->hasMany('App\Transaksi');
    }
}
