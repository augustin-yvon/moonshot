<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClassNameController extends AbstractController
{
    #[Route('/class/name', name: 'app_class_name')]
    public function index(): Response
    {
        return $this->render('class_name/index.html.twig', [
            'controller_name' => 'ClassNameController',
        ]);
    }
}
