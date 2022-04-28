<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

Class PokemonController  extends AbstractController{

    #[Route("/pokemon")]

 public function showPoke (){

    $pokemon=[

        "name"=>"Bulbasaur",
        "description"=>"Este Pokémon nace con una semilla en el lomo, que brota con el paso del tiempo.",
        "image"=>"https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png",
        "code"=>"001"

    ];

    return $this->render("pokemon/showPoke.html.twig",["pokemon"=>$pokemon]);

 } 

}