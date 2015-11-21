<?php
namespace OhTenPHP\Website\SiteBundle\Tests\Services;

use OhTenPHP\Website\SiteBundle\Services\TwitterService;
use PHPUnit_Framework_TestCase;

/**
 * Class TwitterServiceTest
 * @package OhTenPHP\Website\SiteBundle\Tests\Services
 */
class TwitterServiceTest extends PHPUnit_Framework_TestCase
{
    protected $twitterService;
    protected $insert = [
        'foo' => 'bar'
    ];

    protected function setUp()
    {
        $this->twitterService = new TwitterService();
    }

    public function testSetTwitterClient()
    {
        $this->twitterService->setTwitterClient($this->insert);
        $this->assertEquals($this->insert, $this->twitterService->getTwitterClient());
    }

    public function testGetLatestTweets()
    {
        $mockeryMock = \Mockery::mock('AnInexistentClass');
        $mockeryMock->shouldReceive('getTimeline')->once()
            ->andReturn($this->insert);
        $this->twitterService->setTwitterClient($mockeryMock);
        $this->assertEquals($this->insert, $this->twitterService->getLatestTweets());
    }
}
