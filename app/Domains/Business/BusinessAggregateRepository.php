<?php

declare(strict_types=1);

namespace App\Domains\Business;

use EventSauce\LaravelEventSauce\AggregateRootRepository;

/** @method \App\Domains\Business\BusinessAggregate retrieve(\App\Domains\Business\BusinessAggregateId $aggregateRootId) */
final class BusinessAggregateRepository extends AggregateRootRepository
{
    /** @var string */
    protected static $inputFile = __DIR__ . '/BusinessAggregateEvents.yml';

    /** @var string */
    protected static $outputFile = __DIR__ . '/BusinessAggregateEvents.php';

    /** @var string */
    protected $aggregateRoot = BusinessAggregate::class;

    /** @var string */
    protected $table = 'business_aggregate_events';

    /** @var array */
    protected $consumers = [];
}
