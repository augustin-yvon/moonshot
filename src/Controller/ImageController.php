<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/image')]
class ImageController extends AbstractController
{
    #[Route('/new/{post}/{name}/{path}', name: 'image_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Post $post, string $name, string $path): Response
    {
        $image = new Image();
        $image->setName($name);
        $image->setPath($path);
        $image->setPost($post);
        $image->setCreatedAt(new \DateTimeImmutable());

        $entityManager->persist($image);
        $entityManager->flush();

        return $this->redirectToRoute('post_new', ['image' => $image]);
    }
}
