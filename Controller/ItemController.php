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
     * @ParamConverter("item", class="InterneSeanceBundle:Item", options={"id" = "item_id"})
     * 
     */
    public function getItemAction(Meeting $meeting, Item $item) {
        // TODO : Check if requesting user has access to the corresponding meeting container

        $view = $this->view($item, Response::HTTP_OK);

        return $this->handleView($view);
    }

    /**
     * Creates a new Item entity.
     */
    public function newItemAction(Meeting $meeting) {

        $item = new Item();
        // TODO : Add authorization based on meeting container

        return $this->processForm($meeting, $item);
    }


    /**
     * Updates an existing Item Entity.
     * 
     * @ParamConverter("item", class="InterneSeanceBundle:Item", options={"id" = "item_id"})
     * 
     */
    public function editItemAction(Meeting $meeting, Item $item) {
        return $this->processForm($meeting, $item);
    }

    /**
     * Deletes an existing Meeting Entity.
     * 
     * @ParamConverter("item", class="InterneSeanceBundle:Item", options={"id" = "item_id"})
     * 
     */
    public function deleteItemAction(Meeting $meeting, Item $item) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($item);
        $em->flush();

        $view = $this->view();

        return $this->handleView($view);
    }


    // ========================================================
    //                     FORM PROCESSING
    // ========================================================

    private function processForm(Meeting $meeting, Item $item) {
        $em = $this->getDoctrine()->getManager();

        $statusCode = (!$em->contains($item))? Response::HTTP_CREATED : Response::HTTP_NO_CONTENT;

        $form = $this->createForm(new ItemType(), $item);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em->persist($item);
            $em->persist($meeting);
            $em->flush();

            $view = $this->view()->setStatusCode($statusCode);

            // HTTP Convention : return HTTP 201 Created + Location of created resource
            if ($statusCode == Response::HTTP_CREATED) {
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
