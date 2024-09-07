<?php

namespace App\Controller;

use App\Entity\VinylMix;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MixController extends AbstractController
{
    #[Route('/mix/new', name: 'mix_new')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $genres = ['Urban', 'Rock', 'Pop', 'Dance', 'R&B', 'Country', 'Jazz', 'Classical', 'Blues', 'Reggae', 'Metal',
            'Electronic', 'Folk', 'Indie', 'Punk', 'Soul', 'Gospel', 'Latin', 'World', 'New Age', 'Soundtrack', 'Vocal',
            'Easy Listening', 'Comedy', 'Children', 'Holiday', 'Opera', 'Avant-Garde', 'Miscellaneous'];
        $mix = new VinylMix();
        $mix->setTitle('Old Urban Mix');
        $mix->setDescription(sprintf('A mix of old school %s tracks', $mix->getGenre()));
        $mix->setGenre($genres[array_rand($genres)]);
        $mix->setTrackCount(rand(4,20));
        $mix->setVotes(rand(-50, 50));

        $entityManager->persist($mix);
        $entityManager->flush();

        return new Response(sprintf('New Mix %d of %s is %d tracks of pure %s', $mix->getId(), $mix->getGenre() ,$mix->getTrackCount(), $mix->getGenre()));
    }
}