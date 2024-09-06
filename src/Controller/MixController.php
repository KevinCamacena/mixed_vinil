<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MixController extends AbstractController
{
    #[Route('/mix/new', name: 'mix_new')]
    public function new(): Response
    {
        dd('new mix');
    }
}