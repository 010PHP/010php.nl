<?php

namespace OhTenPHP\Website\SiteBundle\Controller;

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
        return [
            'meetup' => $this->get('oh_ten_php_website_site.meetup')->getNextEvent(),
            'tweets' => $this->get('oh_ten_php_website_site.twitter')->getLatestTweets(),
            'rsvpList' => $this->get('oh_ten_php_website_site.meetup')->getRsvpListForNextEvent(),
        ];
    }
}
