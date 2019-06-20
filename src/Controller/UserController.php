<?php
namespace App\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
	/**
     * @Route("/api/user/new", name="new_user", methods={"POST"})
     */
	public function new(EntityManagerInterface $em) {
		$user = $request->request->get('user');
		$email = $request->request->get('email');
		$password = $request->request->get('password');
		$user = new Users();
		$user->setName($user);
		$user->setEmail($email);
		$user->setPassword($password);

		$em->persist($user);
        $em->flush();

		return new Response('User created!!!');
	}
}