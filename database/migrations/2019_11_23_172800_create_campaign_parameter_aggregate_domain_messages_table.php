<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignParameterAggregateDomainMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('campaign_parameter_aggregate_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_id', 36);
            $table->string('event_type', 100);
            $table->string('event_stream', 36)->index();
            $table->dateTime('recorded_at', 6)->index();
            $table->text('payload');
        });
    }

    public function down()
    {
        Schema::dropIfExists('campaign_parameter_aggregate_events');
    }
}
