<?php

namespace Interne\SeanceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Interne\SeanceBundle\Entity\Meeting;
use Interne\SeanceBundle\Form\MeetingType;

/**
 * Controller CRUD des réunions (Meeting entity)
 *
 */
class MeetingController extends Controller
{
    // ========================================================
    //                  GÉNÉRATION DES VUES
    // ========================================================

    /**
     * Afficher la liste de toutes les réunions
     *
     * TODO : Afficher uniquement les réunions du conteneur courant
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InterneSeanceBundle:Meeting')->findAll();

        return $this->render('InterneSeanceBundle:Meeting:index.html.twig', array(
            'entities' => $entities,
        ));
    }


    /**
     * Affiche le formulaire de création d'une réunion
     *
     */
    public function newAction()
    {
        $entity = new Meeting();
        $form   = $this->createCreateForm($entity);

        return $this->render('InterneSeanceBundle:Meeting:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Affiche une réunion existante ainsi que les différents points
     * de l'ordre du jour déjà ajoutés.
     *
     * @throw NotFoundException Si l'entité n'a pu être trouvée
     *
     */
    public function showAction(Meeting $meeting)
    {
        $deleteForm = $this->createDeleteForm($meeting->getId());

        return $this->render('InterneSeanceBundle:Meeting:show.html.twig', array(
            'meeting'      => $meeting,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Meeting entity.
     *
     * @throw NotFoundException Si l'entité n'a pu être trouvée
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InterneSeanceBundle:Meeting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meeting entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InterneSeanceBundle:Meeting:edit.html.twig', array(
            'entity'      => $entity,
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
        $entity = new Meeting();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('meeting_show', array('id' => $entity->getId())));
        }

        return $this->render('InterneSeanceBundle:Meeting:new.html.twig', array(
            'entity' => $entity,
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

        $entity = $em->getRepository('InterneSeanceBundle:Meeting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meeting entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('meeting_edit', array('id' => $id)));
        }

        return $this->render('InterneSeanceBundle:Meeting:edit.html.twig', array(
            'entity'      => $entity,
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

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InterneSeanceBundle:Meeting')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Meeting entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('meeting'));
    }

    // ========================================================
    //               GÉNÉRATION DES FORMULAIRES
    // ========================================================

    /**
     * Génère le formulaire d'ajout d'une nouvelle réunion
     *
     * @param Meeting $entity L'entité
     *
     * @return \Symfony\Component\Form\Form Le formulaire
     */
    private function createCreateForm(Meeting $entity)
    {
        $form = $this->createForm(new MeetingType(), $entity, array(
            'action' => $this->generateUrl('meeting_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
    * Génère le formulaire d'édition d'une réunion existante.
    *
    * @param Meeting $entity L'entité
    *
    * @return \Symfony\Component\Form\Form Le formulaire
    */
    private function createEditForm(Meeting $entity)
    {
        $form = $this->createForm(new MeetingType(), $entity, array(
            'action' => $this->generateUrl('meeting_update', array('id' => $entity->getId())),
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
            ->setAction($this->generateUrl('meeting_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
