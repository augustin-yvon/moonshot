<?php

namespace App\Controller;

use App\Repository\DocumentRepository;
use App\Repository\CourseRepository;
use App\Repository\GradeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/')]
    public function index(DocumentRepository $documentRepository, CourseRepository $courseRepository, GradeRepository $gradeRepository): Response
    {
        $user = $this->getUser();

        if (!$user) {
            // Gestion du cas où l'utilisateur n'est pas connecté
            return $this->redirectToRoute('app_login');
        }

        $documents = $documentRepository->findDocumentsByUser($user);
        $courses = $courseRepository->findCoursesByUser($user);
        $grades = $gradeRepository->findGradesByUser($user);

        return $this->render('default/index.html.twig', [
            'documents' => $documents,
            'courses' => $courses,
            'grades' => $grades,
        ]);
    }
}
