<?php

namespace OhTenPHP\Website\SiteBundle\Services;


use DMS\Service\Meetup\MeetupKeyAuthClient;

/**
 * Class MeetupService
 * @package OhTenPHP\Website\SiteBundle\Services
 */
class MeetupService
{
    /**
     * Holds the meetup client
     * @var
     */
    protected $meetupClient;

    /**
     * MeetupService constructor.
     * @param MeetupKeyAuthClient $meetupClient
     */
    public function __construct(MeetupKeyAuthClient $meetupClient)
    {
        $this->meetupClient = $meetupClient;
    }

    /**
     * Retrieve the events from meetup
     * @return mixed
     */
    public function getEvents()
    {
        return $this->meetupClient->getEvents();
    }

    /**
     * Returns the meetup client
     * @return mixed
     */
    public function getMeetupClient()
    {
        return $this->meetupClient;
    }
}