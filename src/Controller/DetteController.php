<?php
// src/Controller/DetteController.php
namespace App\Controller;

use App\Entity\Dette;
use App\Form\DetteType;
use App\Repository\DetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetteController extends AbstractController
{
    /**
     * @Route("/dettes", name="dettes_index")
     */
    public function index(Request $request, DetteRepository $detteRepository): Response
    {
        $statuts = $request->query->get('statuts', []);
        $dettes = !empty($statuts) ? $detteRepository->findByStatut($statuts) : $detteRepository->findAll();

        return $this->render('dette/index.html.twig', [
            'dettes' => $dettes,
            'statuts' => ['en_attente', 'reglee', 'annulee'], // Liste des statuts
        ]);
    }

    /**
     * @Route("/dettes/create", name="dettes_create")
     */
    public function create(Request $request): Response
    {
        $dette = new Dette();
        $form = $this->createForm(DetteType::class, $dette);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dette);
            $entityManager->flush();

            return $this->redirectToRoute('dettes_index');
        }

        return $this->render('dette/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
