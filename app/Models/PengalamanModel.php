<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengalamanModel extends Model
{
  protected $table    = 'trans_pengalaman_kerja';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'Perusahaan',
    'Posisi',
    'StartDate',
    'EndDate',
    'JobDesc',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];

  use HasFactory;
}
