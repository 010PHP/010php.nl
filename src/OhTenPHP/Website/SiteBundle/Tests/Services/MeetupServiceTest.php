<?php
namespace OhTenPHP\Website\SiteBundle\Tests\Services;

use DMS\Service\Meetup\MeetupKeyAuthClient;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class TwitterServiceTest
 * @package OhTenPHP\Website\SiteBundle\Tests\Services
 */
class MeetupServiceTest extends KernelTestCase
{
    protected $meetupClient;

    public function setUp()
    {
        self::bootKernel();
        $this->meetupClient = static::$kernel->getContainer()->get('oh_ten_php_website_site.meetup');
    }

    public function testEnsureMeetupClientInstance()
    {
        $this->assertInstanceOf(MeetupKeyAuthClient::class, $this->meetupClient);
    }

    public function tearDown()
    {
        self::ensureKernelShutdown();
        unset($this->meetupClient);
    }
}
