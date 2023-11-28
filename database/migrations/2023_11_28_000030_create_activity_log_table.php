<?php

use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration
{
    public function up(): void
    {
        Schema::connection(config('activitylog.database_connection'))
            ->create(config('activitylog.table_name'), function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Team::class)
                    ->nullable()
                    ->constrained()
                    ->nullOnDelete();
                $table->string('log_name')
                    ->nullable();
                $table->text('description');
                $table->nullableMorphs('subject', 'subject');
                $table->string('event')
                    ->nullable();
                $table->nullableMorphs('causer', 'causer');
                $table->json('properties')
                    ->nullable();
                $table->uuid('batch_uuid')
                    ->nullable();
                $table->index('log_name');
                $table->timestamp('created_at')
                    ->nullable();
                $table->softDeletes();
            });
    }

    public function down(): void
    {
        Schema::connection(config('activitylog.database_connection'))->dropIfExists(config('activitylog.table_name'));
    }
};
