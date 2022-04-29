<?php

namespace App\Controller;

use App\Entity\Debilidad;
use App\Entity\Pokemon;
use App\Form\PokemonType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        $debilidad1 = new Debilidad();
        $debilidad1->setTipo("veneno");
        $debilidad2 = new Debilidad();
        $debilidad2->setTipo("agua");
        $debilidad3 = new Debilidad();
        $debilidad3->setTipo("fuego");

        $pokemon1 = new Pokemon();

        
        $pokemon1->setName("Pikachu");
        $pokemon1->setDescription("Cuanto más potente es la energía eléctrica que genera este Pokémon, más suaves y elásticas se vuelven las bolsas de sus mejillas.");
        $pokemon1->setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/025.png");
        $pokemon1->setCode("025");

        $pokemon1->addDebilidade($debilidad1);
        $pokemon1->addDebilidade($debilidad2);

        $pokemon2 = new Pokemon();

        $pokemon2->setName("PEPE");
        $pokemon2->setDescription("descripcion");
        $pokemon2->setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/030.png");
        $pokemon2->setCode("030");

        $doctrine->persist($pokemon1);
        $doctrine->persist($pokemon2);
        $doctrine->persist($debilidad1);
        $doctrine->persist($debilidad2);
        $doctrine->persist($debilidad3);
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

    #[Route("/new/pokemon")]
    public function newPokemon(Request $request, EntityManagerInterface $doctrine ) {
        $form = $this->createForm(PokemonType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pokemon = $form->getData();
            $doctrine->persist($pokemon);
            $doctrine->flush();   
            $this->addFlash("success", "Pokemon insertado correctamente.");
            return $this->redirectToRoute("listpokemon");
        }

        return $this->renderForm("pokemon/newPoke.html.twig", ["pokemonForm" => $form]);
    }

    #[Route("/edit/pokemon/{id}", name: "editPokemon")]
    #[IsGranted('ROLE_ADMIN')]
    public function editPokemon(Request $request, EntityManagerInterface $doctrine, $id)
    {

        $repositorio = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repositorio->find($id);

        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pokemon = $form->getData();
            $doctrine->persist($pokemon);
            $doctrine->flush();
            $this->addFlash("success", "Pokemon editado correctamente.");
            return $this->redirectToRoute("listpokemon");
        }

        return $this->renderForm("pokemon/newPoke.html.twig", ["pokemonForm" => $form]);
    }

    #[Route("/react/pokemon")]
    public function reactPokemon()
    {
        return $this->render("pokemon/reactPoke.html.twig");
    }

}
