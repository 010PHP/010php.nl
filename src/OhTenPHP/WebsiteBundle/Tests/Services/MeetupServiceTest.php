<?php

namespace OhTenPHP\WebsiteBundle\Tests\Services;

use OhTenPHP\WebsiteBundle\Service\MeetupService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class TwitterServiceTest.
 */
class MeetupServiceTest extends KernelTestCase
{
    protected $meetupClient;

    public function setUp()
    {
        self::bootKernel();
        $this->meetupClient = static::$kernel->getContainer()->get('oh_ten_php_website.service.meetup_service');
    }

    public function testEnsureMeetupClientInstance()
    {
        $this->assertInstanceOf(MeetupService::class, $this->meetupClient);
    }

    public function tearDown()
    {
        self::ensureKernelShutdown();
        unset($this->meetupClient);
    }
}
