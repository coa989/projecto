<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('workspace_id');
            $table->foreignId('workspace_role_id');
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('invitation_token', 32)->unique()->nullable();
            $table->timestamp('registered_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
};
