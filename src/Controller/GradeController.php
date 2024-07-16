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
        // Get the currently logged-in user
        $user = $this->getUser();
        
        // Get the grades for the logged-in user
        $grades = $gradeRepository->findByUserWithCourses($user);
        // $grades = $gradeRepository->findBy(['user_id' => $user]);
        // dd($grades);
        // dd($grades[0]->getCourseId()->getName());
        return $this->render('default/index.html.twig', [
            'grades' => $grades,
        ]);
    }
}