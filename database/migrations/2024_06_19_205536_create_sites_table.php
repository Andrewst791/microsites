<?php

use App\Constants\DocumentTypes;
use App\Constants\SiteTypes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 50)->unique();
            $table->string('name', 100)->index();
            $table->text('logo')->nullable();
            $table->enum('document_type', array_column(DocumentTypes::cases(), 'name'));
            $table->enum('site_type', array_column(SiteTypes::cases(), 'name'));
            $table->string('document', 20)->index();
            $table->foreignId('category_id')->constrained();
            $table->timestamp('enabled_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('user_created_id')->comment('From users');
            $table->foreign('user_created_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
