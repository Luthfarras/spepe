<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Siswa;
use App\Pembayaran;

class siswalogin extends Controller
{
  public function siswaLogin(){

      if(session('nama') != null) :
        return redirect('siswa.index');
      endif;

      return view('masuk');
  }
  public function mmasuk(){
    return view('masuk');

  }

   public function login(Request $req){

              $siswa = Siswa::where('nisn', $req->nisn)->get();

              foreach($siswa as $val) :
                  Session::put('id', $val->id);
                  $nama = $val->nama;
              endforeach;

                    Session::put('nama', $nama);
                    Session::put('nisn', $req->nisn);

                    return redirect('dashsiswa');
   }

   public function logout(){

       Session::flush();
       return redirect('loginsiswa');

   }

   public function index(){
    $data = [
        'pembayaran' => Pembayaran::where('id_siswa', Session::get('id'))->paginate(100)
    ];
     return view('siswa.index', $data);
   }
}
