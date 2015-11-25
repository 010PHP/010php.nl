<?php

namespace OhTenPHP\Website\SiteBundle\Services;

use Endroid\Twitter\Twitter;

class TwitterService
{
    /**
     * Holds the amount to retrieve from the twitter timeline.
     */
    const TIMELINE_COUNT = 5;

    /**
     * Holds the twitter client object.
     *
     * @var Twitter
     */
    private $client;

    /**
     * @param Twitter $client
     */
    public function __construct(Twitter $client)
    {
        $this->client = $client;
    }

    /**
     * Returns the latest tweets from the defined user timeline.
     *
     * @return mixed
     */
    public function getLatestTweets()
    {
        return $this->client->getTimeline([
            'count' => self::TIMELINE_COUNT,
        ]);
    }
}
