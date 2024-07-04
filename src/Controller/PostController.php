<?php

// src/Controller/PostController.php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Message;
use App\Entity\Image;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/post')]
class PostController extends AbstractController
{
    #[Route('/new/{post?}/{message?}/{image?}', name: 'post_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager,
        Security $security,
        PostRepository $postRepository,
        int $post = null,
        int $message = null,
        int $image = null
    ): Response
    {
        $postEntity = $post ? $postRepository->find($post) : null;
        $messageEntity = $message ? $entityManager->getRepository(Message::class)->find($message) : null;
        $imageEntity = $image ? $entityManager->getRepository(Image::class)->find($image) : null;

        if ($post && !$postEntity) { throw $this->createNotFoundException('Post not found'); }
        if ($message && !$messageEntity) { throw $this->createNotFoundException('Message not found'); }
        if ($image && !$imageEntity) { throw $this->createNotFoundException('Image not found'); }

        if ($request->isMethod('POST')) {

            if (!$postEntity) {
                $postEntity = new Post();
                $postEntity->setUser($this->getUser());
                $postEntity->setCreatedAt(new \DateTimeImmutable());

                $entityManager->persist($postEntity);
                $entityManager->flush();
            }

            if ($messageEntity) {
                $postEntity->setMessage($messageEntity);
            } else {
                return $this->redirectToRoute('message_new', [
                    'post' => $postEntity->getId(),
                    'text' => $request->request->get('text')
                ]);
            }

            $imageFile = $request->files->get('image_path');
            if ($imageFile) {
                $uploadDirectory = $this->getParameter('images_directory');

                if (!is_dir($uploadDirectory)) {
                    mkdir($uploadDirectory, 0777, true);
                }

                $newFilename = uniqid() . '.' . $imageFile->guessExtension();
                try {
                    $imageFile->move(
                        $uploadDirectory,
                        $newFilename
                    );

                    $imageEntity = new Image();
                    $imageEntity->setName($request->request->get('image_name'));
                    $imageEntity->setPath($newFilename);
                    $imageEntity->setPost($postEntity);
                    $imageEntity->setCreatedAt(new \DateTimeImmutable());

                    $postEntity->addImage($imageEntity);

                } catch (FileException $e) {
                    return $this->render('post/new.html.twig', [
                        'errors' => ['message' => 'Failed to upload image'],
                    ]);
                }
            }

            $errors = $validator->validate($postEntity);

            if (count($errors) > 0) {
                return $this->render('post/new.html.twig', [
                    'errors' => $errors,
                ]);
            }

            $entityManager->persist($postEntity);
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
