<?php

declare(strict_types=1);

namespace Acme\Campaign;

use EventSauce\EventSourcing\Serialization\SerializablePayload;

final class CampaignParameterCreated implements SerializablePayload
{
    /**
     * @var CampaignParameterAggregateId
     */
    private $id;

    /**
     * @var \Acme\Campaign\CampaignAggregateId
     */
    private $campaign_aggregate_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    public function __construct(
        CampaignParameterAggregateId $id,
        \Acme\Campaign\CampaignAggregateId $campaign_aggregate_id,
        string $name,
        string $value
    ) {
        $this->id = $id;
        $this->campaign_aggregate_id = $campaign_aggregate_id;
        $this->name = $name;
        $this->value = $value;
    }

    public function id(): CampaignParameterAggregateId
    {
        return $this->id;
    }

    public function campaign_aggregate_id(): \Acme\Campaign\CampaignAggregateId
    {
        return $this->campaign_aggregate_id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function fromPayload(array $payload): SerializablePayload
    {
        return new CampaignParameterCreated(
            new CampaignParameterAggregateId($payload['id']),
            new \Acme\Campaign\CampaignAggregateId($payload['campaign_aggregate_id']),
            (string) $payload['name'],
            (string) $payload['value']
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => new CampaignParameterAggregateId($this->id),
            'campaign_aggregate_id' => new \Acme\Campaign\CampaignAggregateId($this->campaign_aggregate_id),
            'name' => (string) $this->name,
            'value' => (string) $this->value,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withIdAndCampaign_aggregate_idAndNameAndValue(CampaignParameterAggregateId $id, \Acme\Campaign\CampaignAggregateId $campaign_aggregate_id, string $name, string $value): CampaignParameterCreated
    {
        return new CampaignParameterCreated(
            $id,
            $campaign_aggregate_id,
            $name,
            $value
        );
    }
}

final class CampaignParameterUpdated implements SerializablePayload
{
    /**
     * @var CampaignParameterAggregateId
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    public function __construct(
        CampaignParameterAggregateId $id,
        string $name,
        string $value
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
    }

    public function id(): CampaignParameterAggregateId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function fromPayload(array $payload): SerializablePayload
    {
        return new CampaignParameterUpdated(
            new CampaignParameterAggregateId($payload['id']),
            (string) $payload['name'],
            (string) $payload['value']
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => new CampaignParameterAggregateId($this->id),
            'name' => (string) $this->name,
            'value' => (string) $this->value,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withIdAndNameAndValue(CampaignParameterAggregateId $id, string $name, string $value): CampaignParameterUpdated
    {
        return new CampaignParameterUpdated(
            $id,
            $name,
            $value
        );
    }
}
