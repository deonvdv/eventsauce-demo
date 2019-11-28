<?php

declare(strict_types=1);

namespace App\Domains\Business;

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;

final class BusinessAggregate implements AggregateRoot
{
    use AggregateRootBehaviour;
}
