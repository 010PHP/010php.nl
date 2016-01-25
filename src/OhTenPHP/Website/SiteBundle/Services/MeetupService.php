<?php

namespace OhTenPHP\Website\SiteBundle\Services;

use DMS\Service\Meetup\MeetupKeyAuthClient;
use Stash\Pool;

/**
 * Class MeetupService
 * @package OhTenPHP\Website\SiteBundle\Services
 */
class MeetupService
{
    /**
     *
     */
    const GROUP_URLNAME = '010PHP';
    /**
     *
     */
    const FIVE_MINUTES = 300;

    /**
     * @var MeetupKeyAuthClient
     */
    private $client;
    /**
     * @var Pool
     */
    private $cache;

    /**
     * MeetupService constructor.
     * @param MeetupKeyAuthClient $client
     * @param Pool                $cache
     */
    public function __construct(MeetupKeyAuthClient $client, Pool $cache)
    {
        $this->client = $client;
        $this->cache = $cache;
    }

    /**
     * @return mixed|null
     */
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

    /**
     * @return array|\DMS\Service\Meetup\Response\MultiResultResponse|mixed|null
     */
    public function getRsvpListForNextEvent()
    {
        $cache = $this->cache->getItem(__METHOD__);
        if (!$cache->isMiss()) {
            return $cache->get();
        }

        $rsvpList = $this->client->getRsvps(
            array('group_urlname' => self::GROUP_URLNAME,
                'event_id' => $this->getNextEvent()['id']
            )
        );

        if ($rsvpList->isError()) {
            throw new \RuntimeException($rsvpList->getMessage());
        }

        $rsvpList = $rsvpList->getData();

        $cache->set($rsvpList, self::FIVE_MINUTES);

        return $rsvpList;
    }
}
