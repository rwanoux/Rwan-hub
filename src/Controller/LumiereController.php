<?php

namespace App\Controller;

use App\Entity\Formations;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

final class LumiereController extends AbstractController
{
    #[Route('/lumiere', name: 'app_lumiere')]
    public function index(ChartBuilderInterface $chartBuilder, EntityManagerInterface $entityManager): Response
    {
        $formations = $entityManager->getRepository(Formations::class)
            ->findBy([], ['date' => 'ASC']);


        // Récupérer la première et dernière date
        $firstDate = $formations[0]->getDate();
        $lastDate = end($formations)->getDate();

        // Générer la liste des mois
        $months = [];
        $currentDate = DateTimeImmutable::createFromInterface($firstDate);
        $endDate = DateTimeImmutable::createFromInterface($lastDate);

        while ($currentDate <= $endDate) {
            $months[] = $currentDate->format('M Y'); // Format "Jan 2024"
            $currentDate = $currentDate->modify('first day of next month');
        }
        $xp = [];
        // Récupérer tous les skills uniques
        $skills = [];
        foreach ($formations as $formation) {
            $skills[] = [
                'name' => $formation->getSkill()->getName(),
                'value' => end($xp) + 1
            ];
            $xp[] = end($xp) + 1;
        }
        $totaldata = $months;
        foreach ($formations as $formation) {
            $dateString = $formation->getDate()->format('M Y');
        };

        dd(["mounth" => $months, "xp" => $xp, "formations" => $formations, "skills" => $skills]);
        //dd(['form' => $formations, 'xp' => $xp, 'skills' => $skills]);
        $chart = new Chart('line');
        $chart->setData([
            'labels' => $months,
            'datasets' => [
                [
                    'label' => 'XP',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'data' => $xp
                ]
            ]
        ]);



        return $this->render('lumiere/index.html.twig', [
            'title' => 'Lumièrologue',
            'chart' => $chart
        ]);
    }
}
