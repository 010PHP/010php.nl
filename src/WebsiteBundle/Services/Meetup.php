<?php

namespace WebsiteBundle\Services;

use DMS\Service\Meetup\MeetupKeyAuthClient;
use Stash\Pool;

/**
 * Class Meetup
 * @package WebsiteBundle\Services
 */
class Meetup
{
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
     * @var string
     */
    private $group;

    /**
     * MeetupService constructor.
     * @param MeetupKeyAuthClient $client
     * @param Pool $cache
     * @param array $meetup
     */
    public function __construct(MeetupKeyAuthClient $client, Pool $cache, array $meetup)
    {
        $this->client = $client;
        $this->cache = $cache;
        $this->group = $meetup['groupName'];
    }


    /**
     * @return mixed
     */
    public function nextEvent()
    {
        $cache = $this->cache->getItem(__METHOD__);
        if (!$cache->isMiss()) {
            return $cache->get();
        }

        $events = $this->client->getEvents(['group_urlname' => $this->group]);
        if ($events->isError()) {
            throw new \RuntimeException($events->getMessage());
        }

        $event = $events->getData()[0];
        $cache->set($event, self::FIVE_MINUTES);

        return $event;
    }

    /**
     * @return array|\DMS\Service\Meetup\Response\MultiResultResponse|mixed
     */
    public function nextEventRsvpList()
    {
        $cache = $this->cache->getItem(__METHOD__);

        if (!$cache->isMiss()) {
            return $cache->get();
        }
        $rsvpList = $this->client->getRsvps([
                'group_urlname' => self::GROUP,
                'event_id' => $this->nextEvent()['id']
            ]
        );

        if ($rsvpList->isError()) {
            throw new \RuntimeException($rsvpList->getMessage());
        }

        $rsvpList = $rsvpList->getData();
        $cache->set($rsvpList, self::FIVE_MINUTES);

        return $rsvpList;
    }

}