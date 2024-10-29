<?php

use App\Models\EnergySource;
use App\Models\Particular;
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
    Schema::create('operations', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Particular::class)->constrained('particulars')->cascadeOnDelete();
      $table->foreignIdFor(EnergySource::class)->constrained('energy_sources')->cascadeOnDelete();
      $table->smallInteger('land_amount');
      $table->smallInteger('weight');
      $table->smallInteger('time_of_operation');
      $table->smallInteger('frequency');
      $table->integer('lifespan');
      $table->smallInteger('MU_count');
      $table->smallInteger('fuel_consumption_rate');
      $table->integer('energy');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('operations');
  }
};
