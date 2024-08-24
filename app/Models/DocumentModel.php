<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
  protected $table    = 'trans_document';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'NamaDokumen',
    'TypeDokumen',
    'TypeFile',
    'UkuranFile',
    'File',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];

  use HasFactory;
}
