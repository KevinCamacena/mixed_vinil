<?php

namespace App\Controller;

use Knp\Bundle\TimeBundle\DateTimeFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use function Symfony\Component\String\u;

class VinylController extends AbstractController
{
    #[Route('/', name:'vinyl_homepage')]
    public function homepage(): Response
    {
        $tracks = [
            ['id' => 1, 'song' => "Gansgta's Paradise", 'artist' => 'Coolio'],
            ['id' => 2, 'song' => "Smells Like Teen Spirit", 'artist' => 'Nirvana'],
            ['id' => 3, 'song' => "The Sign", 'artist' => 'Ace of Base'],
            ['id' => 4, 'song' => "No Diggity", 'artist' => 'Blackstreet'],
            ['id' => 5, 'song' => "I Want It That Way", 'artist' => 'Back'],
            ['id' => 6, 'song' => "Say My Name", 'artist' => "Destiny's Child"],
            ['id' => 7, 'song' => "I Will Always Love You", 'artist' => 'Whitney Houston'],

        ];

        return $this->render('vinyl/homepage.html.twig',[
            'title' => 'PB & Jams',
            'tracks' => $tracks,
        ]);
    }

    #[Route('/browse/{slug}', name:'vinyl_browse')]
    public function browse(HttpClientInterface $httpClient, string $slug = null): Response
    {
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;
        $response = $httpClient->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');
        $mixes = $response->toArray();

        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes,
        ]);
    }
}