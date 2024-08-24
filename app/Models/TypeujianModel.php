<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeujianModel extends Model
{
  protected $table    = 'ms_typeujian';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'Nama',
    'Urutan',
    'Status',
    'ContohSoal',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];

  use HasFactory;
}
