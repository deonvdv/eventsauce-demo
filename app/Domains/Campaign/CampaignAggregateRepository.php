<?php

declare(strict_types=1);

namespace Acme\Campaign;

use EventSauce\LaravelEventSauce\AggregateRootRepository;

/** @method \App\Domains\Campaign\CampaignAggregate retrieve(\App\Domains\Campaign\CampaignAggregateId $aggregateRootId) */
final class CampaignAggregateRepository extends AggregateRootRepository
{

    /** @var string */
    protected static $inputFile = __DIR__ . '/CampaignAggregateEvents.yml';

    /** @var string */
    protected static $outputFile = __DIR__ . '/CampaignAggregateEvents.php';

    /** @var string */
    protected $aggregateRoot = CampaignAggregate::class;

    /** @var string */
    protected $table = 'campaign_aggregte_events';

    /** @var array */
    protected $consumers = [];
}
