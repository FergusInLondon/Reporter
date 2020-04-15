<?php namespace App\Entities;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationshipsMigration extends Migration {
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

    public function up()
    {
        foreach($this->relationships as $relationship) {
            Schema::table($relationship[RelationshipsMigration::OnTable], function(Blueprint $table) use ($relationship) {
                $table->foreign($relationship[RelationshipsMigration::OnCol])
                    ->references($relationship[RelationshipsMigration::TargetCol])
                    ->on($relationship[RelationshipsMigration::TargetTable])
                    ->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        foreach($this->relationships as $relationship) {
            Schema::table($relationship[RelationshipsMigration::OnTable], function(Blueprint $table) use ($relationship) {
                $table->dropForeign(
                    sprintf("%s_%s_foreign", $relationship[RelationshipsMigration::OnTable], $relationship[RelationshipsMigration::OnCol])
                );
            });
        }
    }
}