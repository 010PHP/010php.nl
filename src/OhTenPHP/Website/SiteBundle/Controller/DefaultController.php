<?php

namespace OhTenPHP\Website\SiteBundle\Controller;

use Endroid\Twitter\Twitter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template(":default:index.html.twig")
     */
    public function indexAction()
    {
        /** @var Twitter $twitter */
        $twitter = $this->get('endroid.twitter');
        $tweets = $twitter->getTimeline([
            'count' => 5,
        ]);

        return [
            'tweets' => $tweets,
        ];
    }
}
