<?php

namespace Interne\SeanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Interne\SeanceBundle\Entity\Meeting;
use Interne\SeanceBundle\Form\MeetingType;

/**
 * Class NewsController
 * @package Interne\SeanceBundle\Controller
 * @route("/")
 */
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render("InterneSeanceBundle:Default:index.html.twig");
    }

    public function demoAction()
    {
        return $this->render("InterneSeanceBundle:Default:demo.html.twig");
    }
    /**
     * @route("/demo_seance", name="interne_seance_demo_seance")
     * @Template()
     */
    public function seanceAction()
    {
        return array();
    }
}
