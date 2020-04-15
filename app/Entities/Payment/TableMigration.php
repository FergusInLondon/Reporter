<?php namespace App\Entities\Payment;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableMigration extends Migration {
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('document_id');

            $table->enum('status', ['pending', 'failed', 'successful']);
            $table->string('amount');
            $table->dateTimeTz('processed_at', 0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}