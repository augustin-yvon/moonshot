<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Message;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/message')]
class MessageController extends AbstractController
{
    #[Route('/message/{post}/{text}', name: 'message_new')]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        Security $security,
        int $post,
        PostRepository $postRepository,
        string $text): Response
    {
        $postEntity = $post ? $postRepository->find($post) : null;

        if (!$postEntity) { throw $this->createNotFoundException('Post not found'); }

        $message = new Message();
        $message->setText($text);
        $message->setPost($postEntity);
        $message->setCreatedAt(new \DateTimeImmutable());

        $entityManager->persist($message);
        $entityManager->flush();

        return $this->redirectToRoute('post_new', [
            'post' => $postEntity->getId(),
            'message' => $message->getId()
        ]);
    }
}
