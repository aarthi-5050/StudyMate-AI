<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';

    protected $fillable = [

        'title',

        'category',

        'file_name',

        'file_type',

        'document_text'

    ];
}