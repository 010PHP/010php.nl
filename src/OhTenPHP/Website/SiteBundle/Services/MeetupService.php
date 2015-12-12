<?php

namespace OhTenPHP\Website\SiteBundle\Services;

use DMS\Service\Meetup\MeetupKeyAuthClient;
use Stash\Pool;

class MeetupService
{
    const GROUP_URLNAME = '010PHP';
    const FIVE_MINUTES = 300;

    /**
     * @var MeetupKeyAuthClient
     */
    private $client;
    /**
     * @var Pool
     */
    private $cache;

    public function __construct(MeetupKeyAuthClient $client, Pool $cache)
    {
        $this->client = $client;
        $this->cache = $cache;
    }

    public function getNextEvent()
    {
        $cache = $this->cache->getItem(__METHOD__);
        if (!$cache->isMiss()) {
            return $cache->get();
        }

        $events = $this->client->getEvents(array('group_urlname' => self::GROUP_URLNAME));
        if ($events->isError()) {
            throw new \RuntimeException($events->getMessage());
        }

        $event = $events->getData()[0];

        $cache->set($event, self::FIVE_MINUTES);

        return $event;
    }
}
