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
        Schema::table('sites', function (Blueprint $table) {
            $table->json('fields')->nullable()->after('currency_id')->default('{"name": {"type": "TEXT", "label": "Nombres", "required": true, "placeholder": "Nombres"}, "email": {"type": "EMAIL", "label": "Email", "required": true, "placeholder": "Email"}, "document": {"type": "TEXT", "label": "Documento", "required": true, "placeholder": "Documento"}, "last_name": {"type": "TEXT", "label": "Apellidos", "required": true, "placeholder": "Apellidos"}, "document_type": {"type": "TEXT", "label": "Tipo Documento", "required": true, "placeholder": "Tipo Documento"}}');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->dropColumn('fields');
        });
    }
};
