<?php

declare(strict_types=1);

namespace App\Domains\CallTracking;

use EventSauce\LaravelEventSauce\AggregateRootRepository;

/** @method \App\Domains\CallTracking\NumberAggregate retrieve(\App\Domains\CallTracking\NumberAggregateId $aggregateRootId) */
final class NumberAggregateRepository extends AggregateRootRepository
{
    /** @var string */
    protected static $inputFile = __DIR__ . '/NumberAggregateEvents.yml';

    /** @var string */
    protected static $outputFile = __DIR__ . '/NumberAggregateEvents.php';

    /** @var string */
    protected $aggregateRoot = NumberAggregate::class;

    /** @var string */
    protected $table = 'number_aggregate_events';

    /** @var array */
    protected $consumers = [];
}
