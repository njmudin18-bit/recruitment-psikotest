<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasanganModel extends Model
{
  protected $table    = 'trans_pasangan';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'NamaPasangan',
    'TempatLahir',
    'TanggalLahir',
    'Jk',
    'AlamatKtp',
    'Pendidikan',
    'Pekerjaan',
    'Perusahaan',
    'NoHp',
    'Email',
    'Jabatan',
    'Sosmed',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];

  use HasFactory;
}
