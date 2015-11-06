<?php

namespace Interne\SeanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class FrontendController extends Controller
{

    public function baseAction()
    {
        return "";
    }

    public function templateAction($name)
    {
        $allowed = ['home', 'stack', 'meeting_list_active', 'meeting_list_past', 'view_meeting', 'new_meeting'];

        if (!in_array($name, $allowed)) throw Exception();
        
        return $this->render("InterneSeanceBundle:Angular:".$name.".html.twig");
    }

}
