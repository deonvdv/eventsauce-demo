<?php

declare(strict_types=1);

namespace App\Domains\CallTracking;

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;

final class NumberAggregate implements AggregateRoot
{
    use AggregateRootBehaviour;
}
