<?php

use App\Enums\StatusEnum;
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
        Schema::table('instructor_availabilities', function (Blueprint $table) {
            $table->enum('status', [StatusEnum::AVAILABLE->value, StatusEnum::BOOKED->value])
                ->default(StatusEnum::AVAILABLE->value)
                ->after('instructor_id')
                ->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instructor_availabilities', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
