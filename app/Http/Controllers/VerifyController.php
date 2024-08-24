<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FaqModel;
use Illuminate\Support\Facades\URL;

use Telegram\Bot\Laravel\Facades\Telegram;

class VerifyController extends Controller
{
  public function index($hash, $email)
  {
    $Title        = "Verification";
    $SubTitle     = "Verification your email";
    $user         = User::select('name', 'email')->where('email', $email)->count();
    if ($user > 0) {
      User::where('email', $email)->update(['email_verified_at' => date('Y-m-d H:i:s')]);
      $VerificationMessage    = "Verifikasi Sukses !";
      $SubverificationMessage = "Selamat! Akun email <strong>".$email."</strong> telah terverifikasi. Untuk memulai silahkan klik tombol login dibawah atau refresh halaman dashboard anda.";
      $Button                 = '<a href="'.url('/').'/login" target="_blank" class="btn btn-success">Log in</a>';
    } else {
      $VerificationMessage    = "Verifikasi Gagal !";
      $SubverificationMessage = "Oops! Akun email <strong>".$email."</strong> tidak ditemukan. Silahkan daftar ulang dan pastikan email anda benar.";
      $Button                 = '<a href="'.url('/').'/register" target="_blank" class="btn btn-success">Register</a>';
    }

    return view('emails.verification', compact('Title', 'SubTitle', 'VerificationMessage', 'SubverificationMessage', 'Button'));
  }

  public function faq() {
    $Title        = "FAQ";
    $SubTitle     = "FAQ";

    return view('emails.faq', compact('Title', 'SubTitle'));
  }

  public function welcome() {
    //$activity = Telegram::getUpdates();
    //dd('aa', $activity);

    $Title        = "Portal";
    $SubTitle     = "Portal";

    return view('welcome', compact('Title', 'SubTitle'));
  }
}
