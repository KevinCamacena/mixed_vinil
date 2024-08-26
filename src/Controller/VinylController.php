<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class VinylController extends AbstractController
{
    #[Route('/')]
    public function homepage(): Response
    {
        $tracks = [
            ['song' => "Gansgta's Paradise", 'artist' => 'Coolio'],
            ['song' => "Smells Like Teen Spirit", 'artist' => 'Nirvana'],
            ['song' => "The Sign", 'artist' => 'Ace of Base'],
            ['song' => "No Diggity", 'artist' => 'Blackstreet'],
            ['song' => "I Want It That Way", 'artist' => 'Back'],
            ['song' => "Say My Name", 'artist' => "Destiny's Child"],
            ['song' => "I Will Always Love You", 'artist' => 'Whitney Houston'],

        ];

        return $this->render('vinyl/homepage.html.twig',[
            'title' => 'PB & Jams',
            'tracks' => $tracks,
        ]);
    }

    #[Route('/browse/{slug}')]
    public function browse(string $slug = null): Response
    {
        if ($slug) {
            $title = "Genre:".u(str_replace('-', ' ', $slug))->title(true);
        } else {
            $title = "Browse Vinyl";
        }

        return new Response($title);
    }
}