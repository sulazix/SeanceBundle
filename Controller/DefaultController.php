<?php

namespace Interne\SeanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * Class NewsController
 * @package Interne\SeanceBundle\Controller
 * @route("/")
 */
class DefaultController extends Controller
{
    /**
     * @route("/", name="interne_seance")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    /**
     * @route("/demo", name="interne_seance_demo")
     * @Template()
     */
    public function demoAction()
    {
        return array();
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
