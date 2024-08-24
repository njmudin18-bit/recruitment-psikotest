<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanpertanyaanModel extends Model
{
  protected $table    = 'trans_jawaban_pertanyaan';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'KodePertanyaan',
    'Jawaban',
    'Penjelasan',
    'CreatedDate',
    'CreatedBy',
  ];

  use HasFactory;
}
