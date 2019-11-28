<?php

declare(strict_types=1);

namespace App\Domains\Campaign;

use EventSauce\LaravelEventSauce\AggregateRootRepository;

/** @method \App\Domains\Campaign\CampaignParameterAggregate retrieve(\App\Domains\Campaign\CampaignParameterAggregateId $aggregateRootId) */
final class CampaignParameterAggregateRepository extends AggregateRootRepository
{

    /** @var string */
    protected static $inputFile = __DIR__ . '/CampaignParameterAggregateEvents.yml';

    /** @var string */
    protected static $outputFile = __DIR__ . '/CampaignParameterAggregateEvents.php';

    /** @var string */
    protected $aggregateRoot = CampaignParameterAggregate::class;

    /** @var string */
    protected $table = 'campaign_parameter_aggregate_events';

    /** @var array */
    protected $consumers = [];
}
