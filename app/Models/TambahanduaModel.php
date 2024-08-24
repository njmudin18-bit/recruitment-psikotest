<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TambahanduaModel extends Model
{
  protected $table    = 'trans_tambahan_dua';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'NamaInstansi',
    'Keterangan',
    'Waktu',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];

  use HasFactory;
}
