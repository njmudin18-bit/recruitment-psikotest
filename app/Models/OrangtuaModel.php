<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangtuaModel extends Model
{
  protected $table    = 'trans_orangtua';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'Nama',
    'Jk',
    'TempatLahir',
    'TanggalLahir',
    'Alamat',
    'Pendidikan',
    'Pekerjaan',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];

  use HasFactory;
}
