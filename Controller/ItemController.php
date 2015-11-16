<?php

namespace Interne\SeanceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Interne\SeanceBundle\Entity\Meeting;
use Interne\SeanceBundle\Entity\Item;
use Interne\SeanceBundle\Form\ItemType;

/**
 * Controller CRUD des points de l'ordre du jour d'une réunion (Item entity)
 *
 */
class ItemController extends FOSRestController
{

    // ========================================================
    //                     REST ACTIONS
    // ========================================================

    /**
     * Gets the list of all Items for a specific Meeting.
     */
    public function getItemsAction(Meeting $meeting) {
        $em = $this->getDoctrine()->getManager();

        // TODO : Add authorization based on meeting container

        $items = $meeting->getItems();

        $view = $this->view($items, Response::HTTP_OK);

        return $this->handleView($view);
    }

    
    /**
     * Gets a specific Item.
     *
     * Note : This action is only used to keep up with HTTP standards
     * 
     */
    public function getItemAction(Item $item) {
        // TODO : Check if requesting user has access to the corresponding meeting container

        $view = $this->view($item, Response::HTTP_OK);

        return $this->handleView($view);
    }

    /**
     * Creates a new Item entity.
     */
    public function newItemAction() {

        $item = new Item();
        // TODO : Add authorization based on meeting container

        return $this->processForm($item);
    }


    /**
     * Updates an existing Item Entity.
     * 
     */
    public function editItemAction(Item $item) {
        return $this->processForm($item);
    }

    /**
     * Deletes an existing Meeting Entity.
     * 
     */
    public function deleteItemAction(Item $item) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($item);
        $em->flush();

        $view = $this->view();

        return $this->handleView($view);
    }


    // ========================================================
    //                     FORM PROCESSING
    // ========================================================

    private function processForm(Item $item) {

        $created = ($item && null === $item->getId());
        $statusCode = ($created)? Response::HTTP_CREATED : Response::HTTP_NO_CONTENT;
        $method = ($created) ? "POST" : "PUT";

        $form = $this->createForm(new ItemType(), $item, array('method' => $method));
        $form->handleRequest($this->getRequest());

        $view;
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            $view = $this->view()->setStatusCode($statusCode);

            // HTTP Convention : return HTTP 201 Created + Location of created resource
            if ($created) {
                $view->setLocation(
                    $this->generateUrl('get_item', ['id' => $item->getId()])
                );
            }
        } else {
            $view = $this->view($form, Response::HTTP_BAD_REQUEST);
        }

        return $this->handleView($view);
    }
}
