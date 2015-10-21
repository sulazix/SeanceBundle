<?php

namespace Interne\SeanceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Interne\SeanceBundle\Entity\Tag;
use Interne\SeanceBundle\Form\TagType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Symfony\Component\HttpFoundation\Response;


/**
 * Controller des Tags (assignation)
 */
class TagController extends Controller
{
    // ========================================================
    //          GÉNÉRATION DES VUES et Formulaires
    // ========================================================

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        //retourne tous les Tags
        $tags = $em->getRepository('InterneSeanceBundle:Tag')->findAll();

        return $this->render('InterneSeanceBundle:Tag:list_tag.html.twig',array(
            'tags' =>$tags));

    }

    public function showAction()
    {

    }

    public function newAction()
    {

    }
    public function updateAction(Tag $tag, Request $request)
    {
        $editedForm = $this->createForm(new TagType(),$tag);

        $editedForm->handleRequest($request);

        if($editedForm->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

        }

        return $this->redirect($this->generateUrl('tag'));
    }

    /**
     * Ajax
     * Affiche le modal qui permet d'assigner un tag à un point du meeting
     */
    public function ajaxJoinTagAction(Request $request)
    {

        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            /*
             * On envoie le formulaire en modal
             */
            $id = $request->request->get('idPoint');

            $point = null;
            $modelForm = null;
            $model = $em->getRepository('AppBundle:Model')->find($id);
            $modelForm = $this->createForm(new ModelType(),$model,
                array('action' => $this->generateUrl('model_edit',array('model'=>$id))));

            return $this->render('InterneSeanceBundle:Tag:modal_join_tag.html.twig',array('form'=>$modelForm->createView()));

        }
        return new Response();
    }

    public function ajaxGetTagAction(Request $request)
    {

        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            /*
             * On envoie le formulaire en modal
             */
            $id = $request->request->get('idTag');
            $tag = null;
            $tagForm = null;
            if($id == null)
            {
                /*
                 * Ajout
                 */
                $tag = new Tag();
                $tagForm = $this->createForm(new TagType(),$tag,
                    array('action' => $this->generateUrl('tag_create')));
            }
            else
            {
                $tag = $em->getRepository('InterneSeanceBundle:Tag')->find($id);
                $tagForm = $this->createForm(new TagType(),$tag,
                    array('action' => $this->generateUrl('tag_update',array('tag'=>$id))));
            }
            return $this->render('InterneSeanceBundle:Tag:modal_edit_tag.html.twig',array('form'=>$tagForm->createView()));

        }
        return new Response();
    }

    // ========================================================
    //                  Gestion des données
    // ========================================================


    public function createAction(Request $request)
    {
        $newTag = new Tag();
        $newTagForm = $this->createForm(new TagType(),$newTag);

        $newTagForm->handleRequest($request);

        if($newTagForm->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newTag);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tag'));
    }

    public function deleteAction()
    {

    }
}
