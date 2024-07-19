<?php 

namespace App\Service;

use App\Repository\DocumentRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class DocumentService extends AbstractController
{

    public function getDocuments(DocumentRepository $documentRepository, UserInterface $user,UserRepository $userRepository): array
    {
        $user = $userRepository->findUserById($user);
        $classes = $user->getClassId();
        $documents = $documentRepository->findDocumentsByUser($user,$classes);
        
        return $documents;
    }
}