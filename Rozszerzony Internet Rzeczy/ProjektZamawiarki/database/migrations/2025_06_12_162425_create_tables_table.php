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
        Schema::create('tables', function (Blueprint $table) {
            $table->id('tableId');
            $table->string('tableSlug')->unique();
            $table->string('tableName');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('tables')->insert([
            ['tableSlug' => 'table-1', 'tableName' => 'Table 1'],
            ['tableSlug' => 'table-2', 'tableName' => 'Table 2'],
            ['tableSlug' => 'table-3', 'tableName' => 'Table 3'],
            ['tableSlug' => 'table-4', 'tableName' => 'Table 4'],
            ['tableSlug' => 'table-5', 'tableName' => 'Table 5'],
            ['tableSlug' => 'table-6', 'tableName' => 'Table 6'],
            ['tableSlug' => 'table-7', 'tableName' => 'Table 7'],
            ['tableSlug' => 'table-8', 'tableName' => 'Table 8'],
            ['tableSlug' => 'table-9', 'tableName' => 'Table 9'],
            ['tableSlug' => 'table-10', 'tableName' => 'Table 10'],
        ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
