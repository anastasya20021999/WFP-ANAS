<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // return User::create([
        //     'username' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => bcrypt($data['password']),
        //     'status' => 1,
        // ]);
        //request dari parameter
       // print_r($request->all());
        //exit;
        //get nama field html
        //$this->validate($request,[
        //  'nama_kategori'=>'required',
         //   'keterangan_kategori'=>'required|min:15'
        //]);

        
    }
    public function store(Request $request)
    {
        $username=$request->get('username');
        $email=$request->get('email');
        $password=bcrypt($request->get('password'));
        $status=1;

        $user=new User();
        //->nama kolom di db= objek yg suda dibuat
        $user->username=$username;
        $user->email=$email;
        $user->password=$password;
        $user->status=$status;
        $user->save();

        return redirect('login')->with('pesan','berhasil login dengan username'.$username); //balek lagi ke halaman ini
    }
    
}
