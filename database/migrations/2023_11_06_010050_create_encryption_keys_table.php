<?php

use App\Models\EncryptionKey;
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
        Schema::create('encryption_keys', function (Blueprint $table) {
            $table->id();
            $table->string('key', 64);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        for ($i=0; $i < 20; $i++) { 
            EncryptionKey::create([
                'key' => bin2hex(random_bytes(32)),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encryption_keys');
    }
};
