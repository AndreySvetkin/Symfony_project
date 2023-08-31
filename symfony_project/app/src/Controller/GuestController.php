<?php

namespace App\Controller;

use App\Entity\Guest;
use App\Service\{SecurityService,GuestService};
use App\Form\GuestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/guest')]
class GuestController extends AbstractController
{
    public function __construct(
        private SecurityService $securityService,
        private GuestService $guestService,
    ){

    }

    #[IsGranted('ROLE_USER')]
    #[Route('/', name: 'app_guest_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('guest/index.html.twig', [
            'guests' => $this->guestService->findAll(),
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/new', name: 'app_guest_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $guest = new Guest();
        $form = $this->createForm(GuestType::class, $guest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->guestService->save($guest);
            return $this->redirectToRoute('app_guest_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('guest/new.html.twig', [
            'guest' => $guest,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/{id}', name: 'app_guest_show', methods: ['GET'])]
    public function show(Guest $guest): Response
    {
        return $this->render('guest/show.html.twig', [
            'guest' => $guest,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_guest_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Guest $guest): Response
    {
        $form = $this->createForm(GuestType::class, $guest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->guestService->update();
            return $this->redirectToRoute('app_guest_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('guest/edit.html.twig', [
            'guest' => $guest,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_guest_delete', methods: ['POST'])]
    public function delete(Request $request, Guest $guest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$guest->getId(), $request->request->get('_token'))) {
            $this->guestService->delete($guest);
        }

        return $this->redirectToRoute('app_guest_index', [], Response::HTTP_SEE_OTHER);
    }
}
