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
            'tweets' => $this->get('oh_ten_php_website_site.twitter')->getLatestTweets()
        ];
    }
}
