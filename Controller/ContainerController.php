<?php

namespace Interne\SeanceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\FOSRestController;


use Interne\SeanceBundle\Entity\Container;
use Interne\SeanceBundle\Form\ContainerType;

/**
 * REST Controller for managing Containers Entities
 *
 * @see http://williamdurand.fr/2012/08/02/rest-apis-with-symfony2-the-right-way/
 *
 */
class ContainerController extends FOSRestController
{

    // ========================================================
    //                     REST ACTIONS
    // ========================================================

    /**
     * Gets the list of all Containers.
     */
    public function getContainersAction() {
        $em = $this->getDoctrine()->getManager();

        // TODO : Check user access !

        $containers = $em->getRepository('InterneSeanceBundle:Container')->findAll();

        $view = $this->view($containers, Response::HTTP_OK);

        return $this->handleView($view);
    }
}
