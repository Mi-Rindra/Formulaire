<?php

namespace App\Controller;

use Datetime;
use App\Entity\Dirigeant;
use App\Form\DirigeantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DirigeantController extends AbstractController
{
    /**
     * @Route("/dirigeant", name="dirigeant")
     */
    public function index(): Response
    {
        return $this->render('dirigeant/index.html.twig', [
            'controller_name' => 'DirigeantController',
        ]);
    }

    /**
     * @Route("/dirigeant/ajout", name="addDirigeant")
     * @Route("/dirigeant/edit/{id}", name="editDirigeant")
     */
    public function addDirigeant(
        Request $request,
        EntityManagerInterface $manager,
        Dirigeant $dirigeant = NULL
    ):Response
    {
        if(!$dirigeant){
            $dirigeant = new Dirigeant();
        }

        $formDirigeant = $this->createForm(DirigeantType::class, $dirigeant);
        $formDirigeant->handleRequest($request);


        if($formDirigeant->isSubmitted() && $formDirigeant->isValid()){
            $dirigeant->setCreatedat(new \Datetime());
            $manager->persist($dirigeant);
            $manager->flush();

            return $this->redirectToRoute('dirigeant');
        }

        return $this->render('dirigeant/addDirigeant.html.twig',[
            'controller_name' => 'addDirigeant',
            'formDirigeant' => $formDirigeant->createView(),
            'editmode' => $dirigeant->getId()!=NULL,
            'dirigeant' => $dirigeant
        ]);
    }

/**
     * @Route("/dirigeant/remove/{id}", name="removeDirigeant")
     */

    public function removeDirigeant(Dirigeant $dirigeant, Request $request , EntityManagerInterface $manager){
        $manager->remove($dirigeant);
        $manager->flush();
        return $this->redirectToRoute('liste');
    }
}
