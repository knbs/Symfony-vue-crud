<?php
namespace App\Controller;

use App\Entity\Shoes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShoeController extends AbstractController
{
	/**
     * @Route("/api/shoe/new", name="new_shoe", methods={"POST"})
     */
	public function new(Request $request, EntityManagerInterface $em) {
		$data = json_decode($request->getContent(), true );
		$shoe = new Shoes();
		$shoe->setBrand($data['brand']);
		$shoe->setModel($data['model']);
		$shoe->setPrice($data['price']);
		$shoe->setImgUrl($data['imgUrl']);

		$em->persist($shoe);
		$em->flush();

		return new Response('Shoe created!!!');
	}

	/**
     * @Route("/api/shoe/edit", name="edit_shoe", methods={"POST"})
     */
	public function edit(Request $request, EntityManagerInterface $em) {
		$data = json_decode($request->getContent(), true );
		$shoe = $em->getRepository(Shoes::class)->find($data['id']);

		if (!$shoe) {
			throw $this->createNotFoundException('No shoe found for id '.$data['id'] ); 
		}

		$shoe->setBrand($data['brand']);
		$shoe->setModel($data['model']);
		$shoe->setPrice($data['price']);
		$shoe->setImgUrl($data['imgUrl']);
		$em->flush();

		return new Response('Shoe updated!!!');
	}

	/**
     * @Route("/api/shoe/remove", name="remove_shoe", methods={"POST"})
     */
	public function remove(Request $request, EntityManagerInterface $em) {
		$data = json_decode($request->getContent(), true );
		$shoe = $em->getRepository(Shoes::class)->find($data['id']);

		if (!$shoe) {
			throw $this->createNotFoundException('No shoe found for id '.$data['id'] ); 
		}

		$em->remove($shoe);
		$em->flush();

		return new Response('Shoe removed!!!');
	}
}