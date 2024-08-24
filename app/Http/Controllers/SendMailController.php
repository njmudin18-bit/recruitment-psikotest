<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SampleMail;

use Illuminate\Support\Facades\URL;

class SendMailController extends Controller
{
  public function index()
  {
    $Email = "john.doe@mail.com";
    $mailData = [
      'Email'   => 'john.doe@mail.com',
      'Name'    => 'John Doe',
      'Url'     => url('/')."/email-verification/".$Email
    ];
      
    Mail::to('nj.mudin18@gmail.com')->send(new SampleMail($mailData));

    return "Email has been sent.";
  }
}
