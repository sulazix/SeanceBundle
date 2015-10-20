<?php

namespace Interne\SeanceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Interne\SeanceBundle\Entity\Meeting;
use Interne\SeanceBundle\Entity\Item;
use Interne\SeanceBundle\Form\ItemType;

/**
 * Controller CRUD des points de l'ordre du jour d'une réunion (Item entity)
 *
 */
class ItemController extends Controller
{
    // ========================================================
    //                  GÉNÉRATION DES VUES
    // ========================================================

    /**
     * Affiche le formulaire de création d'un ordre du jour
     *
     * @param $meeting_id int L'id de la réunion dans laquelle ajouter le point
     */
    public function newAction($meeting_id = null)
    {
        $item = new Item();

        if (null != $meeting_id) {
            $em = $this->getDoctrine()->getEntityManager();
            $meeting = $em->getRepository('InterneSeanceBundle:Meeting')->find($meeting_id);

            $item->setMeeting($meeting);
        }

        $form   = $this->createCreateForm($item);

        return $this->render('InterneSeanceBundle:Item:new.html.twig', array(
            'item' => $item,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Affiche un point existant.
     *
     * @throw NotFoundHttpException Si l'entité n'a pu être trouvée
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $item = $em->getRepository('InterneSeanceBundle:Item')->find($id);

        if (!$item) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InterneSeanceBundle:Item:show.html.twig', array(
            'item'      => $item,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Affiche le formulaire d'édition d'un point de l'ordre du jour
     *
     * @throw NotFoundHttpException Si l'entité n'a pu être trouvée
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $item = $em->getRepository('InterneSeanceBundle:Item')->find($id);

        if (!$item) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        $editForm = $this->createEditForm($item);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InterneSeanceBundle:Item:edit.html.twig', array(
            'item'      => $item,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }



    // ========================================================
    //                TRAITEMENT DES DONNÉES
    // ========================================================
    

    /**
     * Crée une nouvelle entité Meeting à partir des données reçues.
     *
     */
    public function createAction(Request $request)
    {
        $item = new Item();
        $form = $this->createCreateForm($item);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirect($this->generateUrl('item_show', array('id' => $item->getId())));
        }

        return $this->render('InterneSeanceBundle:Meeting:new.html.twig', array(
            'item' => $item,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Enregistre les changements d'une entité Meeting existante.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $item = $em->getRepository('InterneSeanceBundle:Item')->find($id);

        if (!$item) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($item);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('item_edit', array('id' => $id)));
        }

        return $this->render('InterneSeanceBundle:Item:edit.html.twig', array(
            'item'      => $item,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Supprime une entité.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        $meeting_id = null;

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $item = $em->getRepository('InterneSeanceBundle:Item')->find($id);

            if (!$item) {
                throw $this->createNotFoundException('Unable to find Item entity.');
            }

            $meeting_id = $item->getMeeting()->getId();

            $em->remove($item);
            $em->flush();

            return $this->redirect($this->generateUrl('meeting_show', ['id' => $meeting_id]));
        }
        
        return $this->redirect($this->generateUrl('meeting'));
    }

    // ========================================================
    //               GÉNÉRATION DES FORMULAIRES
    // ========================================================

    /**
     * Génère le formulaire d'ajout d'un nouveau point
     *
     * @param Item $item L'entité
     *
     * @return \Symfony\Component\Form\Form Le formulaire
     */
    private function createCreateForm(Item $item)
    {
        $form = $this->createForm(new ItemType(), $item, array(
            'action' => $this->generateUrl('item_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer'));

        return $form;
    }

    /**
    * Génère le formulaire d'édition d'une réunion existante.
    *
    * @param Meeting $item L'entité
    *
    * @return \Symfony\Component\Form\Form Le formulaire
    */
    private function createEditForm(Item $item)
    {
        $form = $this->createForm(new ItemType(), $item, array(
            'action' => $this->generateUrl('item_update', array('id' => $item->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Génère le formulaire de suppression d'une réunion.
     *
     * @param mixed $id L'identifiant de l'entité
     *
     * @return \Symfony\Component\Form\Form Le formulaire
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('item_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
