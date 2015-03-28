<?php

namespace Lan\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Lan\CoreBundle\Entity\Privacy;
use Lan\CoreBundle\Form\PrivacyType;

/**
 * Privacy controller.
 *
 * @Route("/admin/privacy")
 */
class PrivacyController extends Controller
{

    /**
     * Lists all Privacy entities.
     *
     * @Route("/", name="admin_privacy")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LanCoreBundle:Privacy')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Privacy entity.
     *
     * @Route("/", name="admin_privacy_create")
     * @Method("POST")
     * @Template("LanCoreBundle:Privacy:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Privacy();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_privacy_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Privacy entity.
     *
     * @param Privacy $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Privacy $entity)
    {
        $form = $this->createForm(new PrivacyType(), $entity, array(
            'action' => $this->generateUrl('admin_privacy_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Privacy entity.
     *
     * @Route("/new", name="admin_privacy_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Privacy();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Privacy entity.
     *
     * @Route("/{id}", name="admin_privacy_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LanCoreBundle:Privacy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Privacy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Privacy entity.
     *
     * @Route("/{id}/edit", name="admin_privacy_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LanCoreBundle:Privacy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Privacy entity.');
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
    * Creates a form to edit a Privacy entity.
    *
    * @param Privacy $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Privacy $entity)
    {
        $form = $this->createForm(new PrivacyType(), $entity, array(
            'action' => $this->generateUrl('admin_privacy_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Privacy entity.
     *
     * @Route("/{id}", name="admin_privacy_update")
     * @Method("PUT")
     * @Template("LanCoreBundle:Privacy:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LanCoreBundle:Privacy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Privacy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_privacy_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Privacy entity.
     *
     * @Route("/{id}", name="admin_privacy_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LanCoreBundle:Privacy')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Privacy entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_privacy'));
    }

    /**
     * Creates a form to delete a Privacy entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_privacy_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
