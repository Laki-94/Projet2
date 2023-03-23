<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Repository\CommentairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailProduitController extends AbstractController
{
    #[Route('/detail/produit/{id}', name: 'app_detail_produit')]
    public function index(Produits $produits, CommentairesRepository $commentairesRepository): Response
    {
        // $commentaire1 = $commentairesRepository->findBy(  
        //     [
        //         "produit_id"=> $produits
        //     ]
        //     );
        return $this->render('detail_produit/index.html.twig', [
            'produit' => $produits,
            // "com" => $commentaire1,
        ]);
    }
}


