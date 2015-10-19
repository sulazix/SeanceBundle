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

    public function seanceAction()
    {
        return $this->render("InterneSeanceBundle:Default:seance.html.twig");
    }


}
