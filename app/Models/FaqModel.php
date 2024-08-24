<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqModel extends Model
{
  protected $table    = 'ms_faq';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'StatusAktivasi',
    'TypePertanyaan',
    'Pertanyaan',
    'Jawaban',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];

  use HasFactory;
}
