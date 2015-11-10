<?php

namespace Interne\SeanceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\FOSRestController;


use Interne\SeanceBundle\Entity\Meeting;
use Interne\SeanceBundle\Form\MeetingType;

/**
 * REST Controller for managing Meetings Entities
 *
 * @see http://williamdurand.fr/2012/08/02/rest-apis-with-symfony2-the-right-way/
 *
 */
class MeetingController extends FOSRestController
{

    // ========================================================
    //                     REST ACTIONS
    // ========================================================

    /**
     * Gets the list of all Meetings.
     */
    public function getMeetingsAction() {
        $em = $this->getDoctrine()->getManager();

        // TODO : Filter results based on a container

        $meetings = $em->getRepository('InterneSeanceBundle:Meeting')->findAll();

        $view = $this->view($meetings, Response::HTTP_OK);

        return $this->handleView($view);
    }

    /**
     * Gets a specific Meeting.
     */
    public function getMeetingAction(Meeting $meeting) {
        // TODO : Check if requesting user has access to the corresponding meeting container

        $view = $this->view($meeting, Response::HTTP_OK);

        return $this->handleView($view);
    }

    /**
     * Creates a new Meeting entity.
     */
    public function newMeetingAction() {
        $meeting = new Meeting();
        // TODO : Enforce Meeting's binding to the user's container

        return $this->processForm($meeting);
    }


    /**
     * Updates an existing Meeting Entity.
     */
    public function editMeetingAction(Meeting $meeting) {
        return $this->processForm($meeting);
    }

    /**
     * Deletes an existing Meeting Entity.
     */
    public function deleteMeetingAction(Meeting $meeting) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($meeting);
        $em->flush();

        $view = $this->view();

        return $this->handleView($view);
    }


    // ========================================================
    //                     FORM PROCESSING
    // ========================================================

    private function processForm(Meeting $meeting) {
        $em = $this->getDoctrine()->getManager();

        $statusCode = (!$em->contains($meeting))? Response::HTTP_CREATED : Response::HTTP_NO_CONTENT;

        $form = $this->createForm(new MeetingType(), $meeting);
        $form->handleRequest($this->getRequest());


        $view;
        if ($form->isValid()) {

            $items = $meeting->getItems();
            foreach($items as $item) {
                $item->setMeeting($meeting);
                $em->persist($item);
            }

            $em->persist($meeting);
            $em->flush();

            $view = $this->view()->setStatusCode($statusCode);

            // HTTP Convention : return HTTP 201 Created + Location of created resource
            if ($statusCode == Response::HTTP_CREATED) {
                $view->setLocation(
                    $this->generateUrl('get_meeting', ['id' => $meeting->getId()])
                );
            }
        } else {
            var_dump($meeting);
            $view = $this->view($form, Response::HTTP_BAD_REQUEST);
        }



        return $this->handleView($view);
    }
}
