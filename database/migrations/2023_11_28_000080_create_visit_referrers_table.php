<?php

use App\Models\Url;
use App\Models\VisitReferrerHost;
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
        Schema::create('visit_referrers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(VisitReferrerHost::class)
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Url::class)
                ->constrained()->cascadeOnDelete();
            $table->string('url');
            $table->char('browser_hash', 32);
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visit_referrers');
    }
};
