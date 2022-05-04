<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MainPageController extends AbstractController
{
    #[Route('/', name: 'app_main_page')]
    public function index(): RedirectResponse
    {
        return $this->redirectToRoute('app_course_index');

    }
}
