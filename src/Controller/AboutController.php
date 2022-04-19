<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\CourseRepository;
use App\Entity\Course;


use Doctrine\ORM\EntityManagerInterface;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'app_about')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        
        return $this->render('about/index.html.twig', [
            'controller_name' => 'AboutController',
        ]);
    }
}
