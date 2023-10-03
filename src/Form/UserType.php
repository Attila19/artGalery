<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',TextType::class,[
                'required'=>false,
                'label'=>'email',
                'attr'=>[
                    'placeholder'=>'Saisissez votre email'
                ]
            ])
            ->add('password',TextType::class,[
                'required'=>false,
                'label'=>'mot de passe',
                'attr'=>[
                    'placeholder'=>'Saisissez votre mot de passe'
                ]
            ])
            ->add('nickname',TextType::class,[
                'required'=>false,
                'label'=>'pseudo',
                'attr'=>[
                    'placeholder'=>'Saisissez votre pseudo'
                ]
            ])
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
