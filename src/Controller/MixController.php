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
        $mix = new VinylMix();
        $mix->setTitle('Old Urban Mix');
        $mix->setDescription('A mix of old school Urban tracks');
        $mix->setGenre('Urban');
        $mix->setTrackCount(rand(4,20));
        $mix->setVotes(rand(-50, 50));

        $entityManager->persist($mix);
        $entityManager->flush();

        return new Response(sprintf('New Mix %d is %d tracks of pure %d', $mix->getId(), $mix->getTrackCount(), $mix->getGenre()));
    }
}