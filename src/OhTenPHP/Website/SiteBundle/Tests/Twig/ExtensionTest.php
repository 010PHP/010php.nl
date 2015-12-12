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
            'tweetText',
            'tweetUser',
            'retweet',
        ];

        $filterNames = array_map(function (\Twig_SimpleFilter $filter) {
            return $filter->getName();
        }, $filters);

        foreach ($expectedFilters as $expected) {
            $this->assertContains($expected, $filterNames);
        }
    }

    /**
     * @dataProvider tweets
     */
    public function testFilterTweetText($tweet, $expected)
    {
        $extension = new Extension();
        $filteredText = $extension->filterTweetText($tweet);

        $this->assertSame($expected->text, $filteredText);
    }

    /**
     * @dataProvider tweets
     */
    public function testFilterTweetUser($tweet, $expected)
    {
        $extension = new Extension();
        $user = $extension->filterTweetUser($tweet);

        $this->assertSame($expected->user, $user);
    }

    /**
     * @dataProvider tweets
     */
    public function testFilterRetweet($tweet, $expected)
    {
        $extension = new Extension();
        $retweet = $extension->filterRetweet($tweet);

        $this->assertSame($expected->retweet, $retweet);
    }

    public function tweets()
    {
        $tweet1 = new \stdClass();
        $tweet1->user = new \stdClass();
        $tweet1->user->screen_name = 'reenlokum';
        $tweet1->user->name = 'Reen Lokum';
        $tweet1->text = 'Hello @010php or was it #010php? https://010php.nl';

        $expected1 = new \stdClass();
        $expected1->text = 'Hello <a href="https://twitter.com/010php">@010php</a> or was it';
        $expected1->text .= ' <a href="https://twitter.com/hashtag/010php">#010php</a>? <a href="https://010php.nl">https://010php.nl</a>';
        $expected1->user = '<a href="https://twitter.com/reenlokum">Reen Lokum <small class="text-muted">@reenlokum</small></a>';
        $expected1->retweet = '';

        $tweet2 = new \stdClass();
        $tweet2->user = new \stdClass();
        $tweet2->user->screen_name = 'Caroganet';
        $tweet2->user->name = 'Caroga';
        $tweet2->text = 'RT @reenlokum Hello @010php or was it #010php? https://010php.nl';
        $tweet2->retweeted_status = $tweet1;

        $expected2 = new \stdClass();
        $expected2->text = 'Hello <a href="https://twitter.com/010php">@010php</a> or was it';
        $expected2->text .= ' <a href="https://twitter.com/hashtag/010php">#010php</a>? <a href="https://010php.nl">https://010php.nl</a>';
        $expected2->user = '<a href="https://twitter.com/reenlokum">Reen Lokum <small class="text-muted">@reenlokum</small></a>';
        $expected2->retweet = '<a href="https://twitter.com/Caroganet">Caroga</a>';

        return [
            [$tweet1, $expected1],
            [$tweet2, $expected2],
        ];
    }
}
