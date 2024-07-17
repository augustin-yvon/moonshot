<?php

namespace App\Controller;

use App\Repository\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DocumentController extends AbstractController
{

    #[Route('', name: 'home')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(DocumentRepository $documentRepository): Response
    {
        $user = $this->getUser();

        if ($user) {
            $documents = $documentRepository->findDocumentsByUser($user);

            dd($documents);

            return $this->render('default/index.html.twig', [
                'documents' => $documents,
            ]);
        }

        return $this->redirectToRoute('login');
    }
}
