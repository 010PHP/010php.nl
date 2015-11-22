<?php
namespace OhTenPHP\Website\SiteBundle\Tests\Services;

use Endroid\Twitter\Twitter;
use OhTenPHP\Website\SiteBundle\Services\TwitterService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class TwitterServiceTest
 * @package OhTenPHP\Website\SiteBundle\Tests\Services
 */
class TwitterServiceTest extends KernelTestCase
{
    protected $twitterService;
    protected $insert = [
        'foo' => 'bar'
    ];

    protected function setUp()
    {
        self::bootKernel();
        $this->twitterService = static::$kernel->getContainer()->get('oh_ten_php_website_site.twitter');
    }

    public function testEnsureTwitterClientInstance()
    {
        $this->assertInstanceOf(TwitterService::class, $this->twitterService);
    }

    public function testSetTwitterClient()
    {
        $this->twitterService->setTwitterClient($this->insert);
        $this->assertEquals($this->insert, $this->twitterService->getTwitterClient());
    }

    public function testGetLatestTweets()
    {
        $mockeryMock = \Mockery::mock('AnInexistentClass');
        $mockeryMock
            ->shouldReceive('getTimeline')->once()
            ->andReturn($this->insert);
        $this->twitterService->setTwitterClient($mockeryMock);
        $this->assertEquals($this->insert, $this->twitterService->getLatestTweets());
    }


    public function tearDown()
    {
        self::ensureKernelShutdown();
        unset($this->twitterService);
    }
}
