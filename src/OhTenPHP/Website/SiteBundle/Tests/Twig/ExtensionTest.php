<?php

namespace OhTenPHP\Website\SiteBundle\Tests\Twig;

use OhTenPHP\Website\SiteBundle\Twig\Extension;

class ExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetFilters()
    {
        $extension = new Extension();
        $filters = $extension->getFilters();

        $expectedFilters = [
            'meetupSafePhotoLink',
        ];

        $filterNames = array_map(function (\Twig_SimpleFilter $filter) {
            return $filter->getName();
        }, $filters);

        foreach ($expectedFilters as $expected) {
            $this->assertContains($expected, $filterNames);
        }
    }
}
