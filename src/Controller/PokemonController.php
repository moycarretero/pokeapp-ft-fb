<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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


    #[Route("/insert/pokemon")]
    public function insertPokemon(EntityManagerInterface $doctrine)
    {
        $pokemon1 = new Pokemon();

        $pokemon1->setName("Pikachu");
        $pokemon1->setDescription("Cuanto más potente es la energía eléctrica que genera este Pokémon, más suaves y elásticas se vuelven las bolsas de sus mejillas.");
        $pokemon1->setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/025.png");
        $pokemon1->setCode("025");

        $pokemon2 = new Pokemon();

        $pokemon2->setName("PEPE");
        $pokemon2->setDescription("descripcion");
        $pokemon2->setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/030.png");
        $pokemon2->setCode("030");

        $doctrine->persist($pokemon1);
        $doctrine->persist($pokemon2);
        $doctrine->flush();

        $pokemon3 = new Pokemon();

        $pokemon3->setName("Caterpie");
        $pokemon3->setDescription("Cuanto más potente es la energía eléctrica que genera este Pokémon, más suaves y elásticas se vuelven las bolsas de sus mejillas.");
        $pokemon3->setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/010.png");
        $pokemon3->setCode("010");

        $doctrine->persist($pokemon3);

        $pokemon2->setName("Squirtle");

        $doctrine->flush();

        //return new Response("Pokemon insertado correctamente");
        return $this->render("base.html.twig");

    }


}
