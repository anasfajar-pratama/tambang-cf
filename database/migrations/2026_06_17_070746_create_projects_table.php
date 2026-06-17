<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('description');
            $table->string('location');
            $table->string('mining_type');
            $table->decimal('total_capital', 15, 2);
            $table->decimal('min_investment', 15, 2)->default(1000000);
            $table->enum('investment_type', ['single', 'multi'])->default('multi');
            $table->decimal('investor_share', 5, 2)->comment('Persentase untuk investor');
            $table->decimal('vendor_share', 5, 2)->comment('Persentase untuk vendor');
            $table->integer('duration_months');
            $table->enum('risk_level', ['rendah', 'sedang', 'tinggi'])->default('sedang');
            $table->string('permit_status')->nullable();
            $table->string('luas_lahan')->nullable();
            $table->enum('status', ['draft', 'pending', 'fundraising', 'funded', 'in_progress', 'completed', 'failed'])->default('draft');
            $table->string('cover_image')->nullable();
            $table->date('started_at')->nullable();
            $table->date('ended_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
