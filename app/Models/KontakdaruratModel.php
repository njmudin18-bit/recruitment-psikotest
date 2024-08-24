<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakdaruratModel extends Model
{
  protected $table    = 'trans_kontakdarurat';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'Nama',
    'Hubungan',
    'Alamat',
    'NoHp',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];

  use HasFactory;
}
