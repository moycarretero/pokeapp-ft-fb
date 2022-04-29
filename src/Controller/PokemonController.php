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

    #[Route("/pokemon/{id}", name: "infopokemon")]
    public function showPoke($id, EntityManagerInterface $doctrine)
    {
        $repositorio = $doctrine->getRepository(Pokemon::class);

        $pokemon = $repositorio->find($id);

        return $this->render("pokemon/showPoke.html.twig", ["pokemon" => $pokemon]);
    }

    #[Route("/pokemons", name: "listpokemon")]
    public function listPokemon(EntityManagerInterface $doctrine)

    {
        $repositorio = $doctrine->getRepository(Pokemon::class);

        $pokemons = $repositorio->findAll();

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
