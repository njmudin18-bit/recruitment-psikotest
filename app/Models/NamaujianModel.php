<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaujianModel extends Model
{
  protected $table    = 'ms_ujian';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'Nama',
    'Acak',
    'StartDate',
    'EndDate',
    'Durasi',
    'Score',
    'Pin',
    'Status',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];

  use HasFactory;
}
