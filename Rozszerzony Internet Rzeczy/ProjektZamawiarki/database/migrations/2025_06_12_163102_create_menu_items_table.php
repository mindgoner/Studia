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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id('menuItemId');
            $table->string('menuItemSlug')->unique();
            $table->string('menuItemName');
            $table->string('menuItemDescription')->nullable();
            $table->decimal('menuItemPrice', 10, 2);
            $table->unsignedBigInteger('menuItemCategoryId');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('menuItemCategoryId')
                ->references('menuCategoryId')
                ->on('menu_categories')
                ->onDelete('cascade');
            $table->index('menuItemCategoryId', 'idx_menu_item_category_id');
        });

        DB::table('menu_items')->insert([
            // Zupy:
            [
                'menuItemSlug' => 'rosol',
                'menuItemName' => 'Rosół',
                'menuItemDescription' => 'Tradycyjna polska zupa rosołowa',
                'menuItemPrice' => 12.00,
                'menuItemCategoryId' => 1,
            ],
            [
                'menuItemSlug' => 'barszcz',
                'menuItemName' => 'Barszcz czerwony',
                'menuItemDescription' => 'Zupa z buraków z uszkami',
                'menuItemPrice' => 14.00,
                'menuItemCategoryId' => 1,
            ],
            [
                'menuItemSlug' => 'Jarzynowa',
                'menuItemName' => 'Zupa jarzynowa',
                'menuItemDescription' => 'Zupa z sezonowych warzyw',
                'menuItemPrice' => 10.00,
                'menuItemCategoryId' => 1,
            ],
            [
                'menuItemSlug' => 'Grzybowa',
                'menuItemName' => 'Zupa grzybowa',
                'menuItemDescription' => 'Zupa z leśnych grzybów',
                'menuItemPrice' => 15.00,
                'menuItemCategoryId' => 1,
            ],
            // Dania główne:
            [
                'menuItemSlug' => 'schabowy',
                'menuItemName' => 'Kotlet schabowy',
                'menuItemDescription' => 'Tradycyjny kotlet schabowy z ziemniakami i surówką',
                'menuItemPrice' => 22.00,
                'menuItemCategoryId' => 2,
            ],
            [
                'menuItemSlug' => 'gulasz',
                'menuItemName' => 'Gulasz wołowy',
                'menuItemDescription' => 'Gulasz z wołowiny podawany z kluskami',
                'menuItemPrice' => 25.00,
                'menuItemCategoryId' => 2,
            ],
            [
                'menuItemSlug' => 'pierogi-z-miesem',
                'menuItemName' => 'Pierogi z mięsem',
                'menuItemDescription' => 'Domowe pierogi z farszem mięsnym',
                'menuItemPrice' => 20.00,
                'menuItemCategoryId' => 2,
            ],
            [
                'menuItemSlug' => 'placki-ziemniaczane',
                'menuItemName' => 'Placki ziemniaczane',
                'menuItemDescription' => 'Placki ziemniaczane z sosem grzybowym',
                'menuItemPrice' => 18.00,
                'menuItemCategoryId' => 2,
            ],
            [
                'menuItemSlug' => 'pierogi-ruskie',
                'menuItemName' => 'Pierogi ruskie',
                'menuItemDescription' => 'Pierogi z serem i ziemniakami',
                'menuItemPrice' => 18.00,
                'menuItemCategoryId' => 2,
            ],
            [
                'menuItemSlug' => 'kopytka',
                'menuItemName' => 'Kopytka',
                'menuItemDescription' => 'Kopytka ziemniaczane z sosem pieczarkowym',
                'menuItemPrice' => 16.00,
                'menuItemCategoryId' => 2,
            ],
            [
                'menuItemSlug' => 'ryba-z-grilla',
                'menuItemName' => 'Ryba z grilla',
                'menuItemDescription' => 'Świeża ryba z grilla podawana z warzywami',
                'menuItemPrice' => 28.00,
                'menuItemCategoryId' => 2,
            ],
            // Napoje:
            [
                'menuItemSlug' => 'kompot',
                'menuItemName' => 'Kompot',
                'menuItemDescription' => 'Domowy kompot z sezonowych owoców',
                'menuItemPrice' => 8.00,
                'menuItemCategoryId' => 3,
            ],
            [
                'menuItemSlug' => 'herbata',
                'menuItemName' => 'Herbata',
                'menuItemDescription' => 'Różne rodzaje herbaty',
                'menuItemPrice' => 6.00,
                'menuItemCategoryId' => 3,
            ],
            [
                'menuItemSlug' => 'kawa',
                'menuItemName' => 'Kawa',
                'menuItemDescription' => 'Świeżo parzona kawa',
                'menuItemPrice' => 7.00,
                'menuItemCategoryId' => 3,
            ],
            [
                'menuItemSlug' => 'sok-jablkowy',
                'menuItemName' => 'Sok jabłkowy',
                'menuItemDescription' => 'Świeżo wyciskany sok jabłkowy',
                'menuItemPrice' => 9.00,
                'menuItemCategoryId' => 3,
            ],
            [
                'menuItemSlug' => 'sok-pomaranczowy',
                'menuItemName' => 'Sok pomarańczowy',
                'menuItemDescription' => 'Świeżo wyciskany sok pomarańczowy',
                'menuItemPrice' => 9.00,
                'menuItemCategoryId' => 3,
            ],
            [
                'menuItemSlug' => 'piwo',
                'menuItemName' => 'Piwo',
                'menuItemDescription' => 'Lokalne piwo rzemieślnicze',
                'menuItemPrice' => 10.00,
                'menuItemCategoryId' => 3,
            ],
            [
                'menuItemSlug' => 'wino',
                'menuItemName' => 'Wino',
                'menuItemDescription' => 'Wino białe lub czerwone',
                'menuItemPrice' => 15.00,
                'menuItemCategoryId' => 3,
            ],
            // Desery:
            [
                'menuItemSlug' => 'sernik',
                'menuItemName' => 'Sernik',
                'menuItemDescription' => 'Tradycyjny sernik na zimno',
                'menuItemPrice' => 12.00,
                'menuItemCategoryId' => 4,
            ],
            [
                'menuItemSlug' => 'szarlotka',
                'menuItemName' => 'Szarlotka',
                'menuItemDescription' => 'Domowa szarlotka z lodami',
                'menuItemPrice' => 14.00,
                'menuItemCategoryId' => 4,
            ],
            [
                'menuItemSlug' => 'lody',
                'menuItemName' => 'Lody',
                'menuItemDescription' => 'Lody w różnych smakach',
                'menuItemPrice' => 10.00,
                'menuItemCategoryId' => 4,
            ],
            [
                'menuItemSlug' => 'ciasto-czekoladowe',
                'menuItemName' => 'Ciasto czekoladowe',
                'menuItemDescription' => 'Czekoladowe ciasto z bitą śmietaną',
                'menuItemPrice' => 15.00,
                'menuItemCategoryId' => 4,
            ],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
