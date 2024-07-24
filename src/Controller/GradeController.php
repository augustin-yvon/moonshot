<?php
namespace App\Controller;

use App\Repository\GradeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class GradeController extends AbstractController
{
    #[Route('', name: 'home')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(GradeRepository $gradeRepository): Response
    {
        $user = $this->getUser();
        
        $grades = $gradeRepository->findGradesByUser($user);

        return $this->render('default/index.html.twig', [
            'grades' => $grades,
        ]);
    }
}