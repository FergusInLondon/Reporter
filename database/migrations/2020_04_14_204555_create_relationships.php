<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationships extends Migration
{
    const OnTable = 0;
    const OnCol = 1;
    const TargetCol = 2;
    const TargetTable = 3;

    private $relationships = array(
        ['clients',   'user_id',     'id', 'users' ],
        ['documents', 'user_id',     'id', 'users' ],
        ['documents', 'client_id',   'id', 'clients' ],
        ['files',     'document_id', 'id', 'documents' ],
        ['payments',  'document_id', 'id', 'documents']        
    );

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach($this->relationships as $relationship) {
            Schema::table($relationship[CreateRelationships::OnTable], function(Blueprint $table) use ($relationship) {
                $table->foreign($relationship[CreateRelationships::OnCol])
                    ->references($relationship[CreateRelationships::TargetCol])
                    ->on($relationship[CreateRelationships::TargetTable])
                    ->onDelete('cascade');
            });
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
            Schema::table($relationship[CreateRelationships::OnTable], function(Blueprint $table) use ($relationship) {
                $this->dropTable(
                    sprintf("%s_%s_foreign", $relationship[CreateRelationships::OnTable], $relationship[CreateRelationships::OnCol])
                );
            });
        }
    }
}
