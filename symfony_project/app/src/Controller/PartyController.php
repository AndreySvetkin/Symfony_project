<?php

namespace App\Controller;

use App\Entity\Party;
use App\Form\PartyType;
use App\Service\{PartyService,SecurityService};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/party')]
class PartyController extends AbstractController
{
    public function __construct(
        private SecurityService $securityService,
        private PartyService $partyService,
    ){

    }

    #[IsGranted('ROLE_USER')]
    #[Route('/', name: 'app_party_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('party/index.html.twig', [
            'parties' => $this->partyService->findAll(),
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/new', name: 'app_party_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $party = new Party();
        $form = $this->createForm(PartyType::class, $party);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->partyService->save($party);

            return $this->redirectToRoute('app_party_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('party/new.html.twig', [
            'party' => $party,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/{id}', name: 'app_party_show', methods: ['GET'])]
    public function show(Party $party): Response
    {
        return $this->render('party/show.html.twig', [
            'party' => $party,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_party_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Party $party): Response
    {
        $form = $this->createForm(PartyType::class, $party);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->partyService->update();

            return $this->redirectToRoute('app_party_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('party/edit.html.twig', [
            'party' => $party,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_party_delete', methods: ['POST'])]
    public function delete(Request $request, Party $party): Response
    {
        if ($this->isCsrfTokenValid('delete'.$party->getId(), $request->request->get('_token'))) {
            $this->partyService->delete($party);
        }

        return $this->redirectToRoute('app_party_index', [], Response::HTTP_SEE_OTHER);
    }
}
