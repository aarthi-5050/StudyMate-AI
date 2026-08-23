<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyNote extends Model
{
    protected $table = 'study_notes';

    protected $fillable = [

        'title',

        'subject',

        'description',

        'pdf'

    ];
}