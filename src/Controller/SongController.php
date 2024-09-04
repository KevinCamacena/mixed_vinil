<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController
{

    #[Route('/api/songs/{id<\d+>}', name:'get_song', methods: ['GET'])]
    public function getSong(int $id, LoggerInterface $logger) : Response {
        // TODO
        // Fetch song from database
        $song = [
            'id' => $id,
            'title' => 'Gansgta\'s Paradise',
            'artist' => 'Coolio',
            'genre' => 'Hip Hop',
            'year' => 1995,
            'url' => 'https://symfonycasts.s3.amazonaws.com/sample.mp3',
        ];

        $logger->info('Retrieved song with id: {song}', ['song' => $id]);

        return $this->json($song);
    }
}