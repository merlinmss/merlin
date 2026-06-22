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
        Schema::create('carecell_meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pastor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sectional_leader_id')->constrained('carecell_leaders')->cascadeOnDelete();
            $table->foreignId('carecell_leader_id')->constrained('carecell_leaders')->cascadeOnDelete();
            $table->foreignId('area_id')->constrained('carecell_areas')->cascadeOnDelete();
            $table->date('meeting_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('members_count')->default(0);
            $table->integer('new_members_count')->default(0);
            $table->decimal('offering_amount', 10, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carecell_meetings');
    }
};
