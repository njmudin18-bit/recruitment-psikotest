<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilujianModel extends Model
{
  protected $table    = 'trans_hasilujian';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'IdUjian',
    'Score',
    'Benar',
    'Salah',
    'Kosong',
    'CreatedDate',
    'CreatedBy'
  ];

  use HasFactory;
}
