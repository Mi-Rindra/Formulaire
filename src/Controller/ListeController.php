<?php

namespace App\Controller;

use Datetime;
use App\Entity\Ville;
use App\Entity\Societe;
use App\Form\VilleType;
use App\Entity\Dirigeant;
use App\Form\SocieteType;
use App\Entity\Codepostal;
use App\Form\DirigeantType;
use App\Form\CodepostalType;
use App\Repository\VilleRepository;
use App\Repository\SocieteRepository;
use App\Repository\DirigeantRepository;
use App\Repository\CodepostalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListeController extends AbstractController
{
    /**
     * @Route("/", name="liste")
     */
    public function addInformation(
        Request $request,
        EntityManagerInterface $manager,
        Societe $societe = NULL,
        Dirigeant $dirigeant = NULL,
        Codepostal $codepostal = NULL,
        Ville $ville = NULL,
        DirigeantRepository $reposDirigeant,
        SocieteRepository $reposSociete,
        VilleRepository $reposVille,
        CodepostalRepository $reposCodepostal
    ):Response
    {
        if(isset($_POST['target'])){
            $value = $_POST['target'];
            $societe = $reposSociete->find($value);   
        }else{
            $societe = new Societe();
        }
        
        $formSociete = $this->createForm(SocieteType::class, $societe);
        $formSociete->handleRequest($request);


        if($formSociete->isSubmitted() && $formSociete->isValid()){
            /*$test = $formSociete['codepostal']->getData();
            $val = $reposCodepostal->find($test);
            dd($val->getVIlles());
            $value = $reposVille->findBy(array("codepostal" => $test));
            dd($value); */
            $societe->setCreatedat(new Datetime());
            $manager->persist($societe);
            $manager->flush();

            return $this->redirectToRoute('liste');
        }

        if(isset($_POST['target'])){
            $value = $_POST['target'];
            $dirigeant = $reposDirigeant->find($value);    
        }else{
            $dirigeant = new Dirigeant();
        }

        $formDirigeant = $this->createForm(DirigeantType::class, $dirigeant);
        $formDirigeant->handleRequest($request);
        $target = NULL;

        if($formDirigeant->isSubmitted()){
            $dirigeant->setCreatedat(new \Datetime());
            $manager->persist($dirigeant);
            $manager->flush();

            return $this->redirectToRoute('liste');
        }

        if(!$codepostal){
            $codepostal = new Codepostal();
        }

        $formCodepostal = $this->createForm(CodepostalType::class, $codepostal);
        $formCodepostal->handleRequest($request);


        if($formCodepostal->isSubmitted() && $formCodepostal->isValid()){
            $codepostal->setCreatedat(new \Datetime());
            $manager->persist($codepostal);
            $manager->flush();

            return $this->redirectToRoute('liste');
        }

        if(!$ville){
            $ville = new Ville();
        }

        $formVille = $this->createForm(VilleType::class, $ville);
        $formVille->handleRequest($request);


        if($formVille->isSubmitted() && $formVille->isValid()){
            $ville->setCreatedat(new \Datetime());
            $manager->persist($ville);
            $manager->flush();

            return $this->redirectToRoute('liste');
        }



        $dirigeants = $reposDirigeant->findAll();
        $societes = $reposSociete->findAll();

        return $this->render('liste/index.html.twig', [
            'controller_name' => 'ListeController',
            'dirigeants' => $dirigeants,
            'societes' => $societes,
            'editmode' => $dirigeant->getId()!=NULL
        ]);
    }
}
