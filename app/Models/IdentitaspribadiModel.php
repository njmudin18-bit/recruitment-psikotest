<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentitaspribadiModel extends Model
{
  protected $table    = 'trans_identitaspribadi';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'Nama',
    'TempatLahir',
    'TanggalLahir',
    'Jk',
    'StatusNikah',
    'NoKtp',
    'AlamatKtp',
    'AlamatRumahTinggal',
    'StatusKepemilikan',
    'NoHp',
    'Email',
    'Sosmed',
    'Kewarganegaraan',
    'Agama',
    'BeratBadan',
    'TinggiBadan',
    'GolDarah',
    'Vaksin',
    'Alergi',
    'Department',
    'Posisi',
    'SumberInfo',
    'GajiDiminta',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];

  use HasFactory;
}
