<?php

namespace App\Controller\Admin;

use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

use App\Entity\Employeurs;
use App\Entity\Formations;
use App\Entity\Skills;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ChartBuilderInterface $chartBuilder
    ) {}
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        //access filter to admin index
        if ($user->getEmail() !== 'erwan_lemaire@yahoo.fr') {
            $this->addFlash('error', 'You are not allowed to access this page');
            return $this->redirectToRoute('app_home');
        }

        //retriving data for chart building
        $users = $this->entityManager->getRepository(User::class)->findAll();
        $employeurs = $this->entityManager->getRepository(Employeurs::class)->findAll();
        $skills = $this->entityManager->getRepository(Skills::class)->findAll();
        $formations = $this->entityManager->getRepository(Formations::class)->findAll();
        $entities = [$users, $employeurs, $skills, $formations];
        /*
        //building chart
        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => ['Users', 'Employeurs', 'Skills', 'Formations'],
            'datasets' => [
                [
                    'label' => 'Number of entities',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => array_map(function ($entity) {
                        return count($entity);
                    }, $entities),
                ],
            ]
        ]);

        */
        $chart = $this->chartBuilder->createChart('line');
        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);
        return $this->render('admin/dashboard.html.twig', [
            'chart' => $chart
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Rwan Hub');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('page home', 'fa fa-home', 'app_home');
        yield MenuItem::linkToCrud('Users', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Employeurs', 'fas fa-list', Employeurs::class);
        yield MenuItem::linkToCrud('Skills', 'fas fa-list', Skills::class);
        yield MenuItem::linkToCrud('Formations', 'fas fa-list', Formations::class);
    }
}