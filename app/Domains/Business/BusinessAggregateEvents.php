<?php

declare(strict_types=1);

namespace Acme\Business;

use EventSauce\EventSourcing\Serialization\SerializablePayload;

final class BusinessCreated implements SerializablePayload
{
    /**
     * @var BusinessAggregateId
     */
    private $id;

    /**
     * @var \Acme\Campaign\CampaignAggregateId
     */
    private $campaign_aggregate_id;

    /**
     * @var int
     */
    private $name;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $street2;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $url;

    /**
     * @var float
     */
    private $lat;

    /**
     * @var float
     */
    private $long;

    /**
     * @var array
     */
    private $social;

    public function __construct(
        BusinessAggregateId $id,
        \Acme\Campaign\CampaignAggregateId $campaign_aggregate_id,
        int $name,
        string $street,
        string $street2,
        string $city,
        string $state,
        string $zip,
        string $country,
        string $phone,
        string $url,
        float $lat,
        float $long,
        array $social
    ) {
        $this->id = $id;
        $this->campaign_aggregate_id = $campaign_aggregate_id;
        $this->name = $name;
        $this->street = $street;
        $this->street2 = $street2;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->country = $country;
        $this->phone = $phone;
        $this->url = $url;
        $this->lat = $lat;
        $this->long = $long;
        $this->social = $social;
    }

    public function id(): BusinessAggregateId
    {
        return $this->id;
    }

    public function campaign_aggregate_id(): \Acme\Campaign\CampaignAggregateId
    {
        return $this->campaign_aggregate_id;
    }

    public function name(): int
    {
        return $this->name;
    }

    public function street(): string
    {
        return $this->street;
    }

    public function street2(): string
    {
        return $this->street2;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function zip(): string
    {
        return $this->zip;
    }

    public function country(): string
    {
        return $this->country;
    }

    public function phone(): string
    {
        return $this->phone;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function lat(): float
    {
        return $this->lat;
    }

    public function long(): float
    {
        return $this->long;
    }

    public function social(): array
    {
        return $this->social;
    }

    public static function fromPayload(array $payload): SerializablePayload
    {
        return new BusinessCreated(
            new BusinessAggregateId($payload['id']),
            new \Acme\Campaign\CampaignAggregateId($payload['campaign_aggregate_id']),
            (int) $payload['name'],
            (string) $payload['street'],
            (string) $payload['street2'],
            (string) $payload['city'],
            (string) $payload['state'],
            (string) $payload['zip'],
            (string) $payload['country'],
            (string) $payload['phone'],
            (string) $payload['url'],
            (float) $payload['lat'],
            (float) $payload['long'],
            (array) $payload['social']
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => new BusinessAggregateId($this->id),
            'campaign_aggregate_id' => new \Acme\Campaign\CampaignAggregateId($this->campaign_aggregate_id),
            'name' => (int) $this->name,
            'street' => (string) $this->street,
            'street2' => (string) $this->street2,
            'city' => (string) $this->city,
            'state' => (string) $this->state,
            'zip' => (string) $this->zip,
            'country' => (string) $this->country,
            'phone' => (string) $this->phone,
            'url' => (string) $this->url,
            'lat' => (float) $this->lat,
            'long' => (float) $this->long,
            'social' => (array) $this->social,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withIdAndCampaign_aggregate_idAndNameAndStreetAndStreet2AndCityAndStateAndZipAndCountryAndPhoneAndUrlAndLatAndLongAndSocial(BusinessAggregateId $id, \Acme\Campaign\CampaignAggregateId $campaign_aggregate_id, int $name, string $street, string $street2, string $city, string $state, string $zip, string $country, string $phone, string $url, float $lat, float $long, array $social): BusinessCreated
    {
        return new BusinessCreated(
            $id,
            $campaign_aggregate_id,
            $name,
            $street,
            $street2,
            $city,
            $state,
            $zip,
            $country,
            $phone,
            $url,
            $lat,
            $long,
            $social
        );
    }
}

final class BusinessUpdated implements SerializablePayload
{
    /**
     * @var BusinessAggregateId
     */
    private $id;

    /**
     * @var array
     */
    private $data;

    public function __construct(
        BusinessAggregateId $id,
        array $data
    ) {
        $this->id = $id;
        $this->data = $data;
    }

    public function id(): BusinessAggregateId
    {
        return $this->id;
    }

    public function data(): array
    {
        return $this->data;
    }

    public static function fromPayload(array $payload): SerializablePayload
    {
        return new BusinessUpdated(
            new BusinessAggregateId($payload['id']),
            (array) $payload['data']
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => new BusinessAggregateId($this->id),
            'data' => (array) $this->data,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withIdAndData(BusinessAggregateId $id, array $data): BusinessUpdated
    {
        return new BusinessUpdated(
            $id,
            $data
        );
    }
}
