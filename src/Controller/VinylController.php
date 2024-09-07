<?php

namespace App\Controller;

use App\Repository\VinylMixRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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

    /*
     * symfony console cache:pool:clear cache.app  // Clear the cache
     */
    #[Route('/browse/{slug}', name:'vinyl_browse')]
    public function browse(VinylMixRepository $mixRepository, string $slug = null): Response
    {
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;

        $mixes = $mixRepository->findAllOrderedByVotes($genre);

        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes,
        ]);
    }
}