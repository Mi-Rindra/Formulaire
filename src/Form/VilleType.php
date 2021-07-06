<?php

namespace App\Form;

use App\Entity\Ville;
use App\Entity\Codepostal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            //->add('createdAt')
            //->add('codepostal')
            ->add('codepostal', EntityType::class, [
                'class'=>Codepostal::class,
                'choice_label'=> function(Codepostal $codepostal){
                    return sprintf(' %s', $codepostal->getLibelle());
                },
                'required' => false,
                'placeholder'=>'Selectionner un CodePostal'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ville::class,
        ]);
    }
}
