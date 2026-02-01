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
        Schema::create('parkings', function (Blueprint $table) {
            $table->id('parkingId');
            $table->string('parkingName')->index();
            
            $table->timestamps();
        });

        Schema::create('parking_settings', function (Blueprint $table) {
            $table->id('parkingSettingId');
            $table->string('parkingSettingParkingId');
            $table->string('parkingSettingRuleName');
            $table->string('parkingSettingRuleValue');
            $table->string('parkingSettingRuleValidationType')->nullable()->comment('One of: laravel/regex');
            $table->string('parkingSettingRuleValidationValue')->nullable();
            $table->timestamps();

            $table->unique(['parkingSettingParkingId', 'parkingSettingRuleName'], 'unique_parking_setting_rule_per_parking');
        });

        ParkingSettings::create([
            'parkingSettingRuleName' => 'free_exit_duration_minutes',
            'parkingSettingRuleValue' => '15',
            'parkingSettingRuleValidationType' => 'laravel',
            'parkingSettingRuleValidationValue' => 'integer|min:0',
        ],[
            'parkingSettingRuleName' => 'parking_mode',
            'parkingSettingRuleValue' => 'whitelist',
            'parkingSettingRuleValidationType' => 'laravel',
            'parkingSettingRuleValidationValue' => 'in:whitelist,blacklist',
        ]);

        Schema::create('parking_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('plate')->index();
            $table->timestamp('entry_time');
            $table->timestamp('exit_time')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->boolean('is_free_exit')->default(false);
            $table->timestamps();
        });

        Schema::create('parking_logs', function (Blueprint $table) {
            $table->id();
            $table->string('plate')->index();
            $table->enum('event', ['entry_attempt', 'entry', 'exit', 'exit_forced']);
            $table->boolean('allowed')->default(false);
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_tables');
    }
};
