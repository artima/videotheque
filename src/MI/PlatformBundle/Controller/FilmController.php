<?php

namespace MI\PlatformBundle\Controller;

use MI\PlatformBundle\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
/**
 * Film controller.
 *
 */
class FilmController extends Controller
{
    /**
     * Lists all film entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $films = $em->getRepository('MIPlatformBundle:Film')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $films, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            2/*limit per page*/
        );

        return $this->render('film/index.html.twig', array(
            'films' => $films,
            'pagination' => $pagination
        ));
    }

    /**
     * Creates a new film entity.
     *
     */
    public function newAction(Request $request)
    {
        $film = new Film();
        $form = $this->createForm('MI\PlatformBundle\Form\FilmType', $film);
        $form->handleRequest($request);
        $form->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($film);
            $em->flush();

            return $this->redirectToRoute('film_show', array('slug' => $film->getSlug()));
        }

        return $this->render('film/new.html.twig', array(
            'film' => $film,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a film entity.
     *
     */
    public function showAction(Film $film)
    {
        $deleteForm = $this->createDeleteForm($film);

        return $this->render('film/show.html.twig', array(
            'film' => $film,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing film entity.
     *
     */
    public function editAction(Request $request, Film $film)
    {
        $deleteForm = $this->createDeleteForm($film);
        $editForm = $this->createForm('MI\PlatformBundle\Form\FilmType', $film);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('film_edit', array('slug' => $film->getSlug()));
        }

        return $this->render('film/edit.html.twig', array(
            'film' => $film,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a film entity.
     *
     */
    public function deleteAction(Request $request, Film $film)
    {
        $form = $this->createDeleteForm($film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($film);
            $em->flush();
        }

        return $this->redirectToRoute('film_index');
    }

    /**
     * Creates a form to delete a film entity.
     *
     * @param Film $film The film entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Film $film)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('film_delete', array('id' => $film->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function searchAction(Request $request)
    {
        $form = $this->createForm('MI\PlatformBundle\Form\SearchType');
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $films = $em->getRepository("MIPlatformBundle:Film")->getSearchFilm($data);
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $films, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                2/*limit per page*/
            );
            return $this->render('film/index.html.twig', array(
                'films' => $films,
                'pagination' => $pagination
            ));
        }
        return $this->render('film/search.html.twig', array('form' => $form->createView()));
    }

    public function menu()
    {
        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository("MIPlatformBundle:Film")->findAll();
        $this->render("film/menu.html.twig", $film);
    }
}
