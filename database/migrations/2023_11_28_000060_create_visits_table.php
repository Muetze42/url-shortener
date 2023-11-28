<?php

use App\Models\Url;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Url::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('device_type');
            $table->string('browser_family');
            $table->string('browser_version');
            $table->string('browser_engine');
            $table->string('platform_family')->nullable();
            $table->string('platform_version')->nullable();
            $table->string('device_family');
            $table->string('device_model');
            $table->string('crawler')->nullable();
            $table->string('ip')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
