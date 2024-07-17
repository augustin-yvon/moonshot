<?php 

namespace App\Service;

use App\Repository\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class DocumentService extends AbstractController
{

    public function getDocuments(DocumentRepository $documentRepository, UserInterface $user): array
    {

        $documents = $documentRepository->findDocumentsByUser($user);

        return $documents;
    }
}