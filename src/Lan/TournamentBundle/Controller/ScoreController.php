<?php

namespace Lan\TournamentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Lan\TournamentBundle\Entity\Score;
use Lan\TournamentBundle\Form\ScoreType;

/**
 * Score controller.
 *
 * @Route("/admin/score")
 */
class ScoreController extends Controller
{

    /**
     * Lists all Score entities.
     *
     * @Route("/", name="admin_score")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LanTournamentBundle:Score')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Score entity.
     *
     * @Route("/", name="admin_score_create")
     * @Method("POST")
     * @Template("LanTournamentBundle:Score:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Score();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_score_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Score entity.
     *
     * @param Score $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Score $entity)
    {
        $form = $this->createForm(new ScoreType(), $entity, array(
            'action' => $this->generateUrl('admin_score_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Score entity.
     *
     * @Route("/new", name="admin_score_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Score();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Score entity.
     *
     * @Route("/{id}", name="admin_score_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LanTournamentBundle:Score')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Score entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Score entity.
     *
     * @Route("/{id}/edit", name="admin_score_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LanTournamentBundle:Score')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Score entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Score entity.
    *
    * @param Score $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Score $entity)
    {
        $form = $this->createForm(new ScoreType(), $entity, array(
            'action' => $this->generateUrl('admin_score_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Score entity.
     *
     * @Route("/{id}", name="admin_score_update")
     * @Method("PUT")
     * @Template("LanTournamentBundle:Score:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LanTournamentBundle:Score')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Score entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_score_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Score entity.
     *
     * @Route("/{id}", name="admin_score_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LanTournamentBundle:Score')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Score entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_score'));
    }

    /**
     * Creates a form to delete a Score entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_score_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
