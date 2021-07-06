<?php

namespace App\Controller;

use App\Entity\Codepostal;
use App\Form\CodepostalType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CodepostalController extends AbstractController
{
    /**
     * @Route("/codepostal", name="codepostal")
     */
    public function index(): Response
    {
        return $this->render('codepostal/index.html.twig', [
            'controller_name' => 'CodepostalController',
        ]);
    }

     /**
     * @Route("/codepostal/ajout", name="addCodepostal")
     */
    public function addcodepostal(
        Request $request,
        EntityManagerInterface $manager,
        Codepostal $codepostal = NULL
    ):Response
    {
        if(!$codepostal){
            $codepostal = new Codepostal();
        }

        $formCodepostal = $this->createForm(CodepostalType::class, $codepostal);
        $formCodepostal->handleRequest($request);


        if($formCodepostal->isSubmitted() && $formCodepostal->isValid()){
            $codepostal->setCreatedat(new \Datetime());
            $manager->persist($codepostal);
            $manager->flush();

            return $this->redirectToRoute('codepostal');
        }

        return $this->render('codepostal/addCodepostal.html.twig',[
            'controller_name' => 'addcodepostal',
            'formCodepostal' => $formCodepostal->createView(),
            'editmode' => $codepostal->getId()!=NULL
        ]);
    }
}
