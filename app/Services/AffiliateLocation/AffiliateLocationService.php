<?php

namespace App\Services\AffiliateLocation;

use App\Helpers\Traits\Singleton;

use App\Repositories\OfficeRepository;
use App\Models\Office;

/**
 * Service used to calculate Affiliate Distance from a given Point (Dublin office)
 */
final class AffiliateLocationService
{

    public static function make() : self
    {
        return new self;
    }

    /**
     * Affiliate longitude
     * @var float|int
     */
    private float $longitude = 0;

    /**
     * Affiliate latitude
     *
     * @var float|int
     */
    private float $latitude = 0;

    /**
     * Distance
     *
     * @var float|int
     */
    private float $distance = 0;

    /**
     * Affiliate Location Coordinates
     *
     * @param int|float $latitude
     * @param int|float $longitude
     * @return $this
     */
    public function setCoordinates(float $latitude = 0, float $longitude = 0): self
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * Determinate if Given affiliate is in within 100 km From the office
     *
     * @return bool
     */
    public function isEligible(): bool
    {
        $office = $this->getOffice(Office::DUBLIN_OFFICE_ID);

        // get distance in Meters
        $distance = $this->haversineGreatCircleDistance(
            $office->getAttribute('latitude'),
            $office->getAttribute('longitude'),
            $this->latitude,
            $this->longitude
        );

        // set distance
        $this->setDistance($distance);

        // Affiliate if eligible the distance is within 100 km of the given office
        return $this->getDistance() < Office::DUBLIN_ALLOWED_DISTANCE;
    }

    /**
     * get Distance
     *
     * @return float|int
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Get Office
     *
     * @param int $office_id
     * @return Office
     */
    private function getOffice(int $office_id = 0): Office
    {
       return OfficeRepository::make()->getById($office_id);
    }

    /**
     * Set Distance
     *
     * @param int $distance
     * @return $this
     */
    private function setDistance($distance): self
    {
        $this->distance = (int) round($distance);
        return $this;
    }


    /**
     * Calculates the great-circle distance between two points, with
     * the Haversine formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */
    function haversineGreatCircleDistanceOriginal(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    /**
    * Calculates the great-circle distance between two points, with the Haversine formula.
     *
     * https://en.wikipedia.org/wiki/Haversine_formula
     *
    * @param float $latitudeFrom Latitude of start point
    * @param float $longitudeFrom Longitude of start point
    * @param float $latitudeTo Latitude of target point
    * @param float $longitudeTo Longitude of target point
    * @return float Distance between points in KM
    */
    private function haversineGreatCircleDistance(float $latitudeFrom = 0, float $longitudeFrom = 0, float $latitudeTo = 0, float $longitudeTo = 0): float
    {
        // Radius in KM
        $radius = 6371;

        // Converts the numbers in degrees to the radian equivalent
        $radians = [
            'from' => [
                'latitude' => deg2rad($latitudeFrom),
                'longitude' => deg2rad($longitudeFrom)
            ],

            'to' => [
                'latitude' => deg2rad($latitudeTo),
                'longitude' => deg2rad($longitudeTo)
            ]
        ];

        // calculate distance of points
        $latitudeDistance = (float) ($radians['to']['latitude'] - $radians['from']['latitude']);
        $longitudeDistance = (float) ($radians['to']['longitude'] - $radians['from']['longitude']);

        // calculate angle
        $angle = 2 * asin(sqrt(pow(sin($latitudeDistance / 2), 2) +
                cos($radians['from']['latitude']) * cos($radians['to']['latitude']) * pow(sin($longitudeDistance / 2), 2)));

        // return approx distance
        return (float) ($angle * $radius);
    }
}
