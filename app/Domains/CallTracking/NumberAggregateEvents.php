<?php

declare(strict_types=1);

namespace Acme\CallTracking;

use EventSauce\EventSourcing\Serialization\SerializablePayload;

final class NumberCreated implements SerializablePayload
{
    /**
     * @var NumberAggregateId
     */
    private $id;

    /**
     * @var \Acme\Campaign\CampaignAggregateId
     */
    private $campaign_aggregate_id;

    /**
     * @var string
     */
    private $channel;

    /**
     * @var string
     */
    private $number;

    /**
     * @var bool
     */
    private $record;

    /**
     * @var bool
     */
    private $intercept;

    public function __construct(
        NumberAggregateId $id,
        \Acme\Campaign\CampaignAggregateId $campaign_aggregate_id,
        string $channel,
        string $number,
        bool $record,
        bool $intercept
    ) {
        $this->id = $id;
        $this->campaign_aggregate_id = $campaign_aggregate_id;
        $this->channel = $channel;
        $this->number = $number;
        $this->record = $record;
        $this->intercept = $intercept;
    }

    public function id(): NumberAggregateId
    {
        return $this->id;
    }

    public function campaign_aggregate_id(): \Acme\Campaign\CampaignAggregateId
    {
        return $this->campaign_aggregate_id;
    }

    public function channel(): string
    {
        return $this->channel;
    }

    public function number(): string
    {
        return $this->number;
    }

    public function record(): bool
    {
        return $this->record;
    }

    public function intercept(): bool
    {
        return $this->intercept;
    }

    public static function fromPayload(array $payload): SerializablePayload
    {
        return new NumberCreated(
            new NumberAggregateId($payload['id']),
            new \Acme\Campaign\CampaignAggregateId($payload['campaign_aggregate_id']),
            (string) $payload['channel'],
            (string) $payload['number'],
            (bool) $payload['record'],
            (bool) $payload['intercept']
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => new NumberAggregateId($this->id),
            'campaign_aggregate_id' => new \Acme\Campaign\CampaignAggregateId($this->campaign_aggregate_id),
            'channel' => (string) $this->channel,
            'number' => (string) $this->number,
            'record' => (bool) $this->record,
            'intercept' => (bool) $this->intercept,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withIdAndCampaign_aggregate_idAndChannelAndNumberAndRecordAndIntercept(NumberAggregateId $id, \Acme\Campaign\CampaignAggregateId $campaign_aggregate_id, string $channel, string $number, bool $record, bool $intercept): NumberCreated
    {
        return new NumberCreated(
            $id,
            $campaign_aggregate_id,
            $channel,
            $number,
            $record,
            $intercept
        );
    }
}

final class NumberUpdated implements SerializablePayload
{
    /**
     * @var NumberAggregateId
     */
    private $id;

    /**
     * @var string
     */
    private $channel;

    /**
     * @var string
     */
    private $number;

    /**
     * @var bool
     */
    private $record;

    /**
     * @var bool
     */
    private $intercept;

    public function __construct(
        NumberAggregateId $id,
        string $channel,
        string $number,
        bool $record,
        bool $intercept
    ) {
        $this->id = $id;
        $this->channel = $channel;
        $this->number = $number;
        $this->record = $record;
        $this->intercept = $intercept;
    }

    public function id(): NumberAggregateId
    {
        return $this->id;
    }

    public function channel(): string
    {
        return $this->channel;
    }

    public function number(): string
    {
        return $this->number;
    }

    public function record(): bool
    {
        return $this->record;
    }

    public function intercept(): bool
    {
        return $this->intercept;
    }

    public static function fromPayload(array $payload): SerializablePayload
    {
        return new NumberUpdated(
            new NumberAggregateId($payload['id']),
            (string) $payload['channel'],
            (string) $payload['number'],
            (bool) $payload['record'],
            (bool) $payload['intercept']
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => new NumberAggregateId($this->id),
            'channel' => (string) $this->channel,
            'number' => (string) $this->number,
            'record' => (bool) $this->record,
            'intercept' => (bool) $this->intercept,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withIdAndChannelAndNumberAndRecordAndIntercept(NumberAggregateId $id, string $channel, string $number, bool $record, bool $intercept): NumberUpdated
    {
        return new NumberUpdated(
            $id,
            $channel,
            $number,
            $record,
            $intercept
        );
    }
}
