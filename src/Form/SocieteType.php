<?php

namespace App\Form;

use App\Entity\Ville;
use App\Entity\Societe;
use App\Entity\Codepostal;
use App\Entity\Typesociete;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SocieteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            //->add('type')
            //->add('codepostal')
            ->add('type', EntityType::class, [
                'class'=>Typesociete::class,
                'choice_label'=> function(Typesociete $typesociete){
                    return sprintf(' %s', $typesociete->getNom());
                },
                'expanded' => true,
                'multiple' => true,
                'required' => false,
                'placeholder'=>'Selectionner les Types'])
            ->add('codepostal', EntityType::class, [
                'class'=>Codepostal::class,
                'choice_label'=> function(Codepostal $codepostal){
                    return sprintf(' %s', $codepostal->getLibelle());
                },
                'required' => false,
                'placeholder'=>'Selectionner un CodePostal'])
            ->add('ville', EntityType::class, [
                'class'=>Ville::class,
                'choice_label'=> function(ville $ville){
                    return sprintf(' %s', $ville->getLibelle());
                },
                'required' => false,
                'placeholder'=>'Selectionner une ville'])
           // ->add('ville')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Societe::class,
        ]);
    }
}
