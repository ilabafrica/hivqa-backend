<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSofaRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $table;

    public function __construct()
    {
        $this->table = Config::get('sofa_revisionable.table', 'revisions');
    }
    public function up()
    {
        Schema::create('sofa_revisions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action', 255);
            $table->string('table_name', 255);
            $table->integer('row_id')->unsigned();
            $table->binary('old')->nullable();
            $table->binary('new')->nullable();
            $table->string('user', 255)->nullable();
            $table->string('ip')->nullable();
            $table->string('ip_forwarded')->nullable();
            $table->timestamps();

            $table->index('action');
            $table->index(['table_name', 'row_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sofa_revisions');
    }
}
