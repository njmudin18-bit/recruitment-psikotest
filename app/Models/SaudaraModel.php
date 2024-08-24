<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaudaraModel extends Model
{
  protected $table    = 'trans_saudara';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'Nama',
    'Jk',
    'TempatLahir',
    'TanggalLahir',
    'Pendidikan',
    'Pekerjaan',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];

  use HasFactory;
}
