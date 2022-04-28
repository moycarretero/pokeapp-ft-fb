<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController  extends AbstractController
{

    #[Route("/pokemon")]
    public function showPoke()
    {
        $pokemon = [
            "name" => "Bulbasaur",
            "description" => "Este Pokémon nace con una semilla en el lomo, que brota con el paso del tiempo.",
            "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png",
            "code" => "001"
        ];

        return $this->render("pokemon/showPoke.html.twig", ["pokemon" => $pokemon]);
    }

    #[Route("/pokemons")]
    public function listPokemon()
    {
        $pokemons = [
            [
                "name" => "Bulbasaur",
                "description" => "Este Pokémon nace con una semilla en el lomo, que brota con el paso del tiempo.",
                "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png",
                "code" => "001"
            ],
            [
                "name" => "Charmander",
                "description" => "Este pokemon tiene fuego en la cola.",
                "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png",
                "code" => "004"
            ],
            [
                "name" => "Squirtle",
                "description" => "Cuando retrae su largo cuello en el caparazón, dispara agua a una presión increíble..",
                "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/007.png",
                "code" => "007"
            ],
            [
                "name" => "Caterpie",
                "description" => "Para protegerse, despide un hedor horrible por las antenas con el que repele a sus enemigos.",
                "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/010.png",
                "code" => "001"
            ],
            [
                "name" => "Pikachu",
                "description" => "Cuanto más potente es la energía eléctrica que genera este Pokémon, más suaves y elásticas se vuelven las bolsas de sus mejillas.",
                "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/025.png",
                "code" => "025"
            ],
        ];

        return $this->render("pokemon/listPoke.html.twig", ["pokemons" => $pokemons]);
    }
}
