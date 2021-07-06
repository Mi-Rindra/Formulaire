<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VilleController extends AbstractController
{
    /**
     * @Route("/ville", name="ville")
     */
    public function index(): Response
    {
        return $this->render('ville/index.html.twig', [
            'controller_name' => 'VilleController',
        ]);
    }

     /**
     * @Route("/ville/ajout", name="addVille")
     */
    public function addVille(
        Request $request,
        EntityManagerInterface $manager,
        Ville $ville = NULL
    ):Response
    {
        if(!$ville){
            $ville = new Ville();
        }

        $formVille = $this->createForm(VilleType::class, $ville);
        $formVille->handleRequest($request);


        if($formVille->isSubmitted() && $formVille->isValid()){
            $ville->setCreatedat(new \Datetime());
            $manager->persist($ville);
            $manager->flush();

            return $this->redirectToRoute('ville');
        }

        return $this->render('ville/addVille.html.twig',[
            'controller_name' => 'addVille',
            'formVille' => $formVille->createView(),
            'editmode' => $ville->getId()!=NULL
        ]);
    }
}
