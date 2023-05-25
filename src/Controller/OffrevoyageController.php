<?php

namespace App\Controller;

use App\Entity\Offrevoyage;
use App\Form\OffrevoyageType;
use App\Repository\OffrevoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;


/**
 * @Route("/admin/offrevoyage")
 */
class OffrevoyageController extends AbstractController
{
    /**
     * @Route("/", name="app_offrevoyage_index", methods={"GET"})
     */
    public function index(Request $request, OffrevoyageRepository $offrevoyageRepository): Response
    {
        $startDate = $request->query->get('startDate');
        $endDate = $request->query->get('endDate');

        $startDateObj = ($startDate !== null) ? new DateTime($startDate) : null;
        $endDateObj = ($endDate !== null) ? new DateTime($endDate) : null;

        $offrevoyages = $offrevoyageRepository->findByDateRange($startDateObj, $endDateObj);

        return $this->render('offrevoyage/index.html.twig', [
            'offrevoyages' => $offrevoyages,
        ]);
    }

    /**
     * @Route("/new", name="app_offrevoyage_new", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
    {
        $offrevoyage = new Offrevoyage();
        $form = $this->createForm(OffrevoyageType::class, $offrevoyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offrevoyage);
            $entityManager->flush();

            return $this->redirectToRoute('app_offrevoyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offrevoyage/new.html.twig', [
            'offrevoyage' => $offrevoyage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_offrevoyage_show", methods={"GET"})
     */
    public function show(Offrevoyage $offrevoyage): Response
    {
        return $this->render('offrevoyage/show.html.twig', [
            'offrevoyage' => $offrevoyage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_offrevoyage_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Offrevoyage $offrevoyage): Response
    {
        $form = $this->createForm(OffrevoyageType::class, $offrevoyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_offrevoyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offrevoyage/edit.html.twig', [
            'offrevoyage' => $offrevoyage,
            'form' => $form->createView(),
        ]);
    }

   /**
 * @Route("/{id}", name="app_offrevoyage_delete", methods={"DELETE"})
 */
public function delete(Request $request, Offrevoyage $offrevoyage): Response
{
    if ($this->isCsrfTokenValid('delete'.$offrevoyage->getId(), $request->request->get('_token'))) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($offrevoyage);
        $entityManager->flush();
    }

    return $this->redirectToRoute('app_offrevoyage_index', [], Response::HTTP_SEE_OTHER);
}
    }

        