<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class MenuCategories extends Model
{
    protected $table = 'menu_categories';

    protected $primaryKey = 'menuCategoryId';

    protected $fillable = [
        'menuCategorySlug',
        'menuCategoryName',
    ];

    public $timestamps = true;

    protected $casts = [
        'menuCategoryId' => 'integer',
    ];
}
