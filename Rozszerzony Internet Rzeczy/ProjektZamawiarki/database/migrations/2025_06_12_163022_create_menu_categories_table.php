<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->id('menuCategoryId');
            $table->string('menuCategorySlug')->unique();
            $table->string('menuCategoryName');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('menu_categories')->insert([
            ['menuCategorySlug' => 'zupa', 'menuCategoryName' => 'Zupy'],
            ['menuCategorySlug' => 'dania-glowne', 'menuCategoryName' => 'Dania główne'],
            ['menuCategorySlug' => 'napoje', 'menuCategoryName' => 'Napoje'],
            ['menuCategorySlug' => 'desery', 'menuCategoryName' => 'Desery'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_categories');
    }
};
