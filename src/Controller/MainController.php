<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="HttpDirectRequest")
     */
    public function index(): Response
    {
        $response = new Response();
        $response->setCharset('UTF-8');
        $response->headers->set('Content-Type', 'text/plain');
        $response->setContent('Access restricted. Use console request.');
        return $response;
    }
}
