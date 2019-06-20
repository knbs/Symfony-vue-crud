<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

use App\Entity\Users;
use App\Entity\Shoes;

class DefaultController extends AbstractController
{
    /**
    * @Route("/", name="default")
    */
    public function index()
    {
       return $this->render('index.html.twig');
    }

	/**
    * @Route("/api/shoes", name="shoes")
    */
    public function shoes(EntityManagerInterface $em, SerializerInterface $serializer) {
        $repository = $em->getRepository(Shoes::class);

        $allShoes = $repository->findAll();

        if (empty($allShoes)) {
            throw $this->createNotFoundException("No articles found");
        }else{
            $jsonContent = $serializer->serialize($allShoes, 'json');
            return new Response($jsonContent, 200, ['Content-Type' => 'application/json']);
        }
    }

    /**
    * @Route("/api/users", name="users")
    */
    public function users(EntityManagerInterface $em, SerializerInterface $serializer) {
        $repository = $em->getRepository(Users::class);

        $allUsers = $repository->findAll();

        if (empty($allUsers)) {
            throw $this->createNotFoundException("No articles found");
        }else{
            $jsonContent = $serializer->serialize($allUsers, 'json');
            return new Response($jsonContent, 200, ['Content-Type' => 'application/json']);
        }
    }
}
