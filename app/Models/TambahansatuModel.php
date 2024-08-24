<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TambahansatuModel extends Model
{
  protected $table    = 'trans_tambahan_satu';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'Keterangan',
    'Waktu',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];
  
  use HasFactory;
}
