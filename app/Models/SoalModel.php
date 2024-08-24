<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalModel extends Model
{
  protected $table    = 'trans_soal';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'IdUjian',
    'IdTypeUjian',
    'Soal',
    'A',
    'B',
    'C',
    'D',
    'E',
    'Kunci',
    'Gambar',
    'PosisiGambar',
    'Status',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];

  use HasFactory;
}
