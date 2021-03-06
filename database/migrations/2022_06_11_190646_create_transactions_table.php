<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The database connection that should be used by the migration.
     *
     * @var string
     */
    protected $connection = 'pgsql'; 

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql')->create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idseller')->references('id')->on('sellers');
            $table->foreignId('idbuyer')->references('id')->on('buyers');
            $table->foreignId('iditem')->references('id')->on('items');
            $table->double('price', 8, 2);
            $table->integer('count');
            $table->double('total_price', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
