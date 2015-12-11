<?php

namespace OhTenPHP\Website\SiteBundle\Twig;

class Extension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('tweetText', [$this, 'filterTweetText'], [
                'is_safe' => ['html'],
            ]),
            new \Twig_SimpleFilter('tweetUser', [$this, 'filterTweetUser'], [
                'is_safe' => ['html'],
            ]),
            new \Twig_SimpleFilter('retweet', [$this, 'filterRetweet'], [
                'is_safe' => ['html'],
            ]),
        ];
    }

    public function filterTweetUser($tweet)
    {
        if (isset($tweet->retweeted_status)) {
            $tweet = $tweet->retweeted_status;
        }

        return '<a href="https://twitter.com/'.$tweet->user->screen_name.'">'.$tweet->user->name.' <small class="text-muted">@'.$tweet->user->screen_name.'</small></a>';
    }

    public function filterRetweet($tweet)
    {
        if (!isset($tweet->retweeted_status)) {
            return '';
        }

        return '<i class="glyphicon glyphicon-refresh"></i> <a href="https://twitter.com/'.$tweet->user->screen_name.'">'.$tweet->user->name.'</a> Retweeted<br>';
    }

    public function filterTweetText($tweet)
    {
        if (isset($tweet->retweeted_status)) {
            $tweet = $tweet->retweeted_status;
        }

        $body = htmlentities($tweet->text, ENT_COMPAT, 'utf-8');
        $body = preg_replace('#(https?://[^\s"]+)#', '<a href="\1">\1</a>', $body);
        $body = preg_replace('#@([A-Za-z0-9]+)#', '<a href="https://twitter.com/\1">@\1</a>', $body);

        return $body;
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
