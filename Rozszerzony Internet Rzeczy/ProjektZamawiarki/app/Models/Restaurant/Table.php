<?php

namespace App\Models\Restaurant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'tableId';

    protected $fillable = [
        'tableSlug',
        'tableName',
    ];

    protected $dates = [
        'deleted_at',
    ];
}
