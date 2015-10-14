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
     * @route("/meeting/add")
     * @Template()
     */
    public function addMeetingAction() {
        $meeting = new Meeting();

        $form = $this->createForm(new MeetingType(), $meeting);
        return ["form" => $form->createView()];
    }
}
