<?php

namespace App\Form;

use App\Entity\Graine;
use App\Entity\Famille;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GraineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('nomFamille', EntityType::class, [
                'class' => Famille::class,
                'choice_label' => 'libelle'
            ])
            ->add('periodePlantation', DateType::class)
            ->add('periodeRecolte', DateType::class)
            ->add('conseils', TextareaType::class)
            ->add('image', TextType::class)
            ->add('quantite', IntegerType::class)
            ->add('ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Graine::class,
        ]);
    }
}
