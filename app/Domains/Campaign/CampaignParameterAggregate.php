<?php

declare(strict_types=1);

namespace App\Domains\Campaign;

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;

final class CampaignParameterAggregate implements AggregateRoot
{
    use AggregateRootBehaviour;
}
