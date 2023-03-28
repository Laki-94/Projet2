<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[ROUTE('/cart')]
class CartController extends AbstractController
{

    // page d'ajout de produit
    #[Route('/add/{id}', name: 'app_cart_add')]
    public function index($id, RequestStack $session): Response {
        // cree ou modifier la variable session set

        // créé mon panier
        $panier = $session->getSession()->get("panier", []);

//        var_dump($panier);
        if (empty($panier[$id])) {
    //        var_dump($panier);
            $panier[$id] = 0;
    //        var_dump($panier);
        }

        $panier[$id]++;
//        var_dump($panier);

        $session->getSession()->set("panier", $panier);
      //  var_dump($panier);


        dd($panier);

        // dd($produit);
        return $this->render('cart/index.html.twig', [
            'panier' => $panier,
        ]);
    }

    // page pour visualiser notre panier
    #[Route('/show', name: 'app_cart_show')]
    public function show(ProduitsRepository $produitsRepository, RequestStack $session): Response
    {
        //get pour recuperer la session

        $session->getSession()->get("panier");
        $panier=$session->getSession()->get("panier");

        // panier a alimenter de sorte d'avoir 
        // toutes les infos du produits

        $panier_complet=[];
        $total = 0;

        foreach ($panier as $key => $value){
            $produit_encours= $produitsRepository->find($key);

            $panier_complet[]=[
                'produits'=> $produitsRepository ->find($key) ,
                'quantite' => $value,
                'total' => ($produit_encours->getPrix()*$value)
            ];

            $total=$total+($produit_encours->getPrix()*$value);
        }
        // dd($panier_complet);
        return $this->render('cart/index.html.twig', [
            'panier' => $panier_complet,
            'total' => $total
            
        ]);
    }

    // page pour vider notre panier
    #[Route('/clear', name: 'app_cart_clear')]
    public function clear(RequestStack $session): Response
    {
        // remove pour vider la session
        $session->getSession()->remove("panier");


        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
}
