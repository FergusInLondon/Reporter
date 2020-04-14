<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationships extends Migration
{
    const OnTable = 0;
    const OnCol = 1;
    const TargerTable = 2;
    const TargetCol = 3;


    private $relationships = array(
        ['clients',   'user_id',     'id', 'users' ],
        ['documents', 'user_id',     'id', 'users' ],
        ['documents', 'client_id',   'id', 'clients' ],
        ['file',      'document_id', 'id', 'documents' ],
        ['payments',  'document_id', 'id', 'documents']        
    )

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach($this->relationships as $relationship) {
            Schema::table($relationship[self::OnTable], function(Blueprint $table){
                $table->foreign($relationship[self::OnCol])
                    ->references($relationship[self::TargetCol])
                    ->on($relationship[self::TargetTable])
                    ->onDelete('cascade');
            })
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach($this->relationships as $relationship) {
            Schema::table($relationship[self::OnTable], function(Blueprint $table){
                $this->dropTable(
                    sprintf("%s_%s_foreign", $relationship[self::OnTable], $relationship[self::OnCol])
                );
            })
        }

    }
}
