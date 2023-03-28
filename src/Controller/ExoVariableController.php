<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExoVariableController extends AbstractController
{
    #[Route('/exo/variable', name: 'app_exo_variable')]
    public function index(RequestStack $requestStack): Response
    {
        $tab_identite=[
            "nom"=>"Khellout",
            "prenom"=>"public",
            "age"=>"36"
        ];
        $requestStack->getSession()->set("identite", $tab_identite);

        $requestStack->getSession()->set("identite,",[
            "nom"=>"Khellout",
            "prenom"=>"public",
            "age"=>"36"
        ]);
        
        return $this->render('exo_variable/index.html.twig', [
            'controller_name' => 'ExoVariableController',
        ]);
    }
}
