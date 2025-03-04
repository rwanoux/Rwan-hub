<?php

namespace App\Controller;

use App\Entity\Employeurs;
use App\Entity\Formations;
use App\Entity\Skills;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Model\Chart;

final class LumiereController extends AbstractController
{
    #[Route('/lumiere', name: 'app_lumiere')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $employeurs = $entityManager->getRepository(Employeurs::class)->findBy(['favorite' => true]);
        $formations = $entityManager->getRepository(Formations::class)
            ->findBy([], ['date' => 'ASC']);

        $timelineData = array_map(function ($formation) {
            return [
                'id' => $formation->getId(),
                'content' => $formation->getSkill()->getName(),
                'start' => $formation->getDate()->format('Y-m-d'),
                'style' => sprintf('background-color: %s', $formation->getSkill()->getColor())
            ];
        }, $formations);

        return $this->render('lumiere/index.html.twig', [
            'timelineData' => json_encode($timelineData),
            'title' => 'Lumièrologue',
            'employeurs' => $employeurs
        ]);
    }
}
