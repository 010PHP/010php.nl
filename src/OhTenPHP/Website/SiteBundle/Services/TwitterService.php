<?php
namespace OhTenPHP\Website\SiteBundle\Services;

/**
 * Class TwitterService
 * @package OhTenPHP\Website\SiteBundle\Services
 */
class TwitterService
{
    /**
     * Holds the default amount to retrieve from the twitter timeline.
     */
    const DEFAULT_TIMELINE_COUNT = 5;

    /**
     * Holds the twitter client object
     * @var
     */
    protected $twitterClient;

    /**
     * Returns the latest tweets from the defined user timeline
     * @param int $count
     * @return mixed
     */
    public function getLatestTweets($count = self::DEFAULT_TIMELINE_COUNT)
    {
        $twitter = $this->getTwitterClient();
        return $twitter->getTimeline([
            'count' => $count,
        ]);
    }

    /**
     * Returns the twitter client object
     * @return mixed
     */
    public function getTwitterClient()
    {
        return $this->twitterClient;
    }

    /**
     * Sets the twitter client object
     * @param mixed $twitterClient
     */
    public function setTwitterClient($twitterClient)
    {
        $this->twitterClient = $twitterClient;
    }
}