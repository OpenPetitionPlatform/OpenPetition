<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainPageController extends AbstractController
{
    #[Route('/', name: 'app_main_page')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_petition_page', ["petition_id" => $this->getParameter('app.petition_id')]);
    }
}
