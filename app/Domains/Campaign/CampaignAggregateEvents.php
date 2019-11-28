<?php

declare(strict_types=1);

namespace Acme\Campaign;

use EventSauce\EventSourcing\Serialization\SerializablePayload;

final class CampaignCreated implements SerializablePayload
{
    /**
     * @var int
     */
    private $version;

    /**
     * @var CampaignAggregateId
     */
    private $id;

    /**
     * @var int
     */
    private $user_id;

    /**
     * @var string
     */
    private $objective;

    /**
     * @var string
     */
    private $eaid;

    /**
     * @var string
     */
    private $eiid;

    /**
     * @var string
     */
    private $listing_id;

    /**
     * @var string
     */
    private $thryv_id;

    /**
     * @var string
     */
    private $cid;

    /**
     * @var float
     */
    private $budget;

    /**
     * @var array
     */
    private $business;

    /**
     * @var array
     */
    private $campaign_parameters;

    public function __construct(
        int $version,
        CampaignAggregateId $id,
        int $user_id,
        string $objective,
        string $eaid,
        string $eiid,
        string $listing_id,
        string $thryv_id,
        string $cid,
        float $budget,
        array $business,
        array $campaign_parameters
    ) {
        $this->version = $version;
        $this->id = $id;
        $this->user_id = $user_id;
        $this->objective = $objective;
        $this->eaid = $eaid;
        $this->eiid = $eiid;
        $this->listing_id = $listing_id;
        $this->thryv_id = $thryv_id;
        $this->cid = $cid;
        $this->budget = $budget;
        $this->business = $business;
        $this->campaign_parameters = $campaign_parameters;
    }

    public function version(): int
    {
        return $this->version;
    }

    public function id(): CampaignAggregateId
    {
        return $this->id;
    }

    public function user_id(): int
    {
        return $this->user_id;
    }

    public function objective(): string
    {
        return $this->objective;
    }

    public function eaid(): string
    {
        return $this->eaid;
    }

    public function eiid(): string
    {
        return $this->eiid;
    }

    public function listing_id(): string
    {
        return $this->listing_id;
    }

    public function thryv_id(): string
    {
        return $this->thryv_id;
    }

    public function cid(): string
    {
        return $this->cid;
    }

    public function budget(): float
    {
        return $this->budget;
    }

    public function business(): array
    {
        return $this->business;
    }

    public function campaign_parameters(): array
    {
        return $this->campaign_parameters;
    }

    public static function fromPayload(array $payload): SerializablePayload
    {
        return new CampaignCreated(
            (int) $payload['version'],
            new CampaignAggregateId($payload['id']),
            (int) $payload['user_id'],
            (string) $payload['objective'],
            (string) $payload['eaid'],
            (string) $payload['eiid'],
            (string) $payload['listing_id'],
            (string) $payload['thryv_id'],
            (string) $payload['cid'],
            (float) $payload['budget'],
            (array) $payload['business'],
            (array) $payload['campaign_parameters']
        );
    }

    public function toPayload(): array
    {
        return [
            'version' => (int) $this->version,
            'id' => new CampaignAggregateId($this->id),
            'user_id' => (int) $this->user_id,
            'objective' => (string) $this->objective,
            'eaid' => (string) $this->eaid,
            'eiid' => (string) $this->eiid,
            'listing_id' => (string) $this->listing_id,
            'thryv_id' => (string) $this->thryv_id,
            'cid' => (string) $this->cid,
            'budget' => (float) $this->budget,
            'business' => (array) $this->business,
            'campaign_parameters' => (array) $this->campaign_parameters,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withVersionAndIdAndUser_idAndObjectiveAndEaidAndEiidAndListing_idAndThryv_idAndCidAndBudgetAndBusinessAndCampaign_parameters(int $version, CampaignAggregateId $id, int $user_id, string $objective, string $eaid, string $eiid, string $listing_id, string $thryv_id, string $cid, float $budget, array $business, array $campaign_parameters): CampaignCreated
    {
        return new CampaignCreated(
            $version,
            $id,
            $user_id,
            $objective,
            $eaid,
            $eiid,
            $listing_id,
            $thryv_id,
            $cid,
            $budget,
            $business,
            $campaign_parameters
        );
    }
}

final class CampaignUpdated implements SerializablePayload
{
    /**
     * @var int
     */
    private $version;

    /**
     * @var CampaignAggregateId
     */
    private $id;

    /**
     * @var array
     */
    private $data;

    public function __construct(
        int $version,
        CampaignAggregateId $id,
        array $data
    ) {
        $this->version = $version;
        $this->id = $id;
        $this->data = $data;
    }

    public function version(): int
    {
        return $this->version;
    }

    public function id(): CampaignAggregateId
    {
        return $this->id;
    }

    public function data(): array
    {
        return $this->data;
    }

    public static function fromPayload(array $payload): SerializablePayload
    {
        return new CampaignUpdated(
            (int) $payload['version'],
            new CampaignAggregateId($payload['id']),
            (array) $payload['data']
        );
    }

    public function toPayload(): array
    {
        return [
            'version' => (int) $this->version,
            'id' => new CampaignAggregateId($this->id),
            'data' => (array) $this->data,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withVersionAndIdAndData(int $version, CampaignAggregateId $id, array $data): CampaignUpdated
    {
        return new CampaignUpdated(
            $version,
            $id,
            $data
        );
    }
}
