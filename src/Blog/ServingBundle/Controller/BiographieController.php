<?php

namespace Blog\ServingBundle\Controller;

use Blog\ServingBundle\Entity\Biographie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Blog\ServingBundle\Twig\AppExtension;


/**
 * Biographie controller.
 *
 * @Route("biographie")
 */
class BiographieController extends Controller
{
    /**
     * Lists all biographie entities.
     *
     * @Route("/", name="biographie_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $biographies = $em->getRepository('BlogServingBundle:Biographie')->findAll();

        return $this->render('biographie/index.html.twig', array(
            'biographies' => $biographies,
        ));
    }

    /**
     * Creates a new biographie entity.
     *
     * @Route("/new", name="biographie_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $biographie = new Biographie();
        $form = $this->createForm('Blog\ServingBundle\Form\BiographieType', $biographie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($biographie);
            $em->flush($biographie);

            return $this->redirectToRoute('biographie_show', array('id' => $biographie->getId()));
        }

        return $this->render('biographie/new.html.twig', array(
            'biographie' => $biographie,
            'form' => $form->createView(),
            'text' => 'testeSpam'
        ));
    }

    /**
     * Finds and displays a biographie entity.
     *
     * @Route("/{id}", name="biographie_show")
     * @Method("GET")
     */
    public function showAction(Biographie $biographie)
    {
        $deleteForm = $this->createDeleteForm($biographie);

        return $this->render('biographie/show.html.twig', array(
            'biographie' => $biographie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing biographie entity.
     *
     * @Route("/{id}/edit", name="biographie_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Biographie $biographie)
    {
        $deleteForm = $this->createDeleteForm($biographie);
        $editForm = $this->createForm('Blog\ServingBundle\Form\BiographieType', $biographie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('biographie_edit', array('id' => $biographie->getId()));
        }

        return $this->render('biographie/edit.html.twig', array(
            'biographie' => $biographie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a biographie entity.
     *
     * @Route("/{id}", name="biographie_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Biographie $biographie)
    {
        $form = $this->createDeleteForm($biographie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($biographie);
            $em->flush($biographie);
        }

        return $this->redirectToRoute('biographie_index');
    }

    /**
     * Creates a form to delete a biographie entity.
     *
     * @param Biographie $biographie The biographie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Biographie $biographie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('biographie_delete', array('id' => $biographie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
