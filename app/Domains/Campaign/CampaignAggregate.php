<?php

declare(strict_types=1);

namespace Acme\Campaign;

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;

final class CampaignAggregate implements AggregateRoot
{
    use AggregateRootBehaviour;
}
