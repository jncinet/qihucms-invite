<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary()
                ->comment('用户ID');
            $table->unsignedBigInteger('parent_id')->default(0)
                ->index()
                ->comment('师父ID');
            $table->unsignedBigInteger('grandfather_id')->default(0)
                ->index()
                ->comment('太师ID');
            $table->unsignedBigInteger('son_count')->default(0)
                ->comment('徒弟数');
            $table->unsignedBigInteger('grandson_count')->default(0)
                ->comment('徒孙数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invites');
    }
}
