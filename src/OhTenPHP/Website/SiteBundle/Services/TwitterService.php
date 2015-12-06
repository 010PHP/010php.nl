<?php

namespace OhTenPHP\Website\SiteBundle\Services;

use Endroid\Twitter\Twitter;
use Stash\Pool;

class TwitterService
{
    /**
     * Holds the amount to retrieve from the twitter timeline.
     */
    const TIMELINE_COUNT = 5;

    /**
     * Hold the time (in seconds) to cache the tweets.
     */
    const FIVE_MINUTES = 300;

    /**
     * Holds the twitter client object.
     *
     * @var Twitter
     */
    private $client;

    /**
     * @var Pool
     */
    private $cache;

    /**
     * @param Twitter $client
     * @param Pool    $cache
     */
    public function __construct(Twitter $client, Pool $cache)
    {
        $this->client = $client;
        $this->cache = $cache;
    }

    /**
     * Returns the latest tweets from the defined user timeline.
     *
     * @return mixed
     */
    public function getLatestTweets()
    {
        $cache = $this->cache->getItem(__METHOD__);
        if (!$cache->isMiss()) {
            return $cache->get();
        }

        $latestTweets = $this->client->getTimeline([
            'count' => self::TIMELINE_COUNT,
        ]);

        if (isset($latestTweets['errors'])) {
            throw new \RuntimeException($latestTweets['errors'][0]->message);
        }

        $cache->set($latestTweets, self::FIVE_MINUTES);

        return $latestTweets;
    }
}
