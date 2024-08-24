<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatantambahanModel extends Model
{
  protected $table    = 'trans_catatan_tambahan';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'Keterangan',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];

  use HasFactory;
}
