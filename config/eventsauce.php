<?php

use Acme\Campaign\CampaignAggregateRepository;
use App\Domains\Business\BusinessAggregateRepository;
use App\Domains\CallTracking\NumberAggregateRepository;
use App\Domains\Campaign\CampaignParameterAggregateRepository;
use Todos\TodoRepository;

return [

    /*
     * The default database connection name, used to store messages.
     * When null is provided it'll use the default application connection.
     */

    'connection' => env('EVENTSAUCE_CONNECTION'),

    /*
     * The default database table name, used to store messages.
     */

    'table' => env('EVENTSAUCE_TABLE', 'events'),

    /*
     * Here you specify all of your aggregate root repositories.
     * We'll use this info to generate commands and events.
     *
     * More info on code generation here:
     * https://eventsauce.io/docs/getting-started/create-events-and-commands
     */

    'repositories' => [
        // App\Domain\MyAggregateRoot\MyAggregateRootRepository::class,
        TodoRepository::class,
        CampaignAggregateRepository::class,
        CampaignParameterAggregateRepository::class,
        BusinessAggregateRepository::class,
        NumberAggregateRepository::class,
    ],

];
