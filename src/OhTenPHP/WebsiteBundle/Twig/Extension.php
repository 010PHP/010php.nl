<?php

namespace OhTenPHP\WebsiteBundle\Twig;

class Extension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('meetupSafePhotoLink', [$this, 'filterMeetupSafePhotoLink'], [
                'is_safe' => ['html'],
            ]),
        ];
    }

    /**
     * Filters meetup profile photo urls and change them to use the safe url
     * @param $link
     * @return mixed
     */
    public function filterMeetupSafePhotoLink($link)
    {
        $link = preg_replace('~(^http\:\/\/.+\.meetupstatic)~', 'https://www.meetupstatic', $link);
        return $link;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'ohten';
    }
}
