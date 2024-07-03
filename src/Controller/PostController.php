<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/post')]
class PostController extends AbstractController
{
    #[Route('/new', name: 'post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ValidatorInterface $validator, EntityManagerInterface $entityManager, Security $security): Response
    {
        if ($request->isMethod('POST')) {

            $post = new Post();
            $post->setUser($this->getUser());
            $post->setCreatedAt(new \DateTimeImmutable());

            $errors = $validator->validate($post);

            if (count($errors) > 0) {
                return $this->render('post/new.html.twig', [
                    'errors' => $errors,
                ]);
            }

            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('post_index');
        }

        return $this->render('post/new.html.twig');
    }

    #[Route('/', name: 'post_index', methods: ['GET'])]
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }
}
