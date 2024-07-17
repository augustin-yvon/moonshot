<?php 

namespace App\Service;

use App\Repository\GradeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class GradeService extends AbstractController
{

    public function getGrades(GradeRepository $gradeRepository, UserInterface $user): array
    {
        
        $grades = $gradeRepository->findGradesByUser($user);

        return $grades;
    }
}