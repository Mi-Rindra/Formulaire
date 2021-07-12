<?php

namespace App\Controller;

use Datetime;
use App\Entity\Societe;
use App\Form\SocieteType;
use App\Repository\VilleRepository;
use App\Repository\CodepostalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SocieteController extends AbstractController
{
    /**
     * @Route("/societe", name="societe")
     */
    public function index(): Response
    {
        return $this->render('societe/index.html.twig', [
            'controller_name' => 'SocieteController',
        ]);
    }

    /**
     * @Route("/societe/ajout", name="addSociete")
     * @Route("/societe/edit/{id}", name="editSociete")
     */
    public function addSociete(
        Request $request,
        EntityManagerInterface $manager,
        Societe $societe = NULL
    ):Response
    {
        if(!$societe){
            $societe = new Societe();
        }

        $formSociete = $this->createForm(SocieteType::class, $societe);
        $formSociete->handleRequest($request);


        if($formSociete->isSubmitted() && $formSociete->isValid()){
            dd($societe);
            $societe->setCreatedat(new Datetime());
            $manager->persist($societe);
            $manager->flush();

            return $this->redirectToRoute('societe');
        }

        return $this->render('societe/addSociete.html.twig',[
            'controller_name' => 'addsociete',
            'formSociete' => $formSociete->createView(),
            'editmode' => $societe->getId()!=NULL,
            'societe' => $societe
        ]);
    }

    /**
     * @Route("/societe/remove/{id}", name="removeSociete")
     */
    public function removeSociete(Societe $societe, Request $request , EntityManagerInterface $manager){
        $manager->remove($societe);
        $manager->flush();
        return $this->redirectToRoute('liste');
    }

    /**
     * @Route("/societe/codeVille/{id}", name="codeVille")
     */
    public function codeVille(
        Request $request,
        EntityManagerInterface $manager,
        VilleRepository $reposVille
        ){
        
        $IdCodepostal = $request->attributes->get('id');
        $villes = $reposVille->findByCodepostal($IdCodepostal);
        return $this->render('liste/codepostal.html.twig',[
            'controller_name' => 'addsociete',
            'villes' => $villes
        ]);
    }
}
