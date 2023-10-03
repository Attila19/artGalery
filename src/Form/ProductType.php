<?php

namespace App\Form;

use App\Entity\Product;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,[
                'required'=>false,
                'label'=>'nom de l\'oeuvre',
                'attr'=>[
                    'placeholder'=>'Intitulé de l\'oeuvre'
                ]
            ])
            ->add('picture_src', TextType::class,[
                'required'=>false,
                'label'=>'reference de l\'URL ou nom de fichier',
                'attr'=>[
                    'placeholder'=>'référence interne en galerie'
                ]
            ])
            ->add('picture_name', TextType::class,[
                'required'=>false,
                'label'=>'nom populaire',
                'attr'=>[
                    'placeholder'=>'nom public de l\'oeuvre'
                ]
            ])
            ->add('price', NumberType::class,[
                'required'=>false,
                'label'=>'le prix',
                'attr'=>[
                    'placeholder'=>'Saisissez le prix de vente'
                ]
            ])
            ->add('disponibility', BooleanType::class,[
                'required'=>false,
                'label'=>'cette oeuvre est vendue?',
                'attr'=>[
                    'placeholder'=>'disponibilité de l\'oeuvre'
                ]
            ])
            ->add('description',TextareaType::class, [
                'required'=>false,
                'label'=>'description',
                'attr'=>[
                    'placeholder'=>'saisissez les informations sur l\'oeuvre'
                ]
            ])
            ->add('Valider',SubmitType::class )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
