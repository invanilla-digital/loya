<?php

declare(strict_types=1);

namespace App\Infrastructure\Users\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserCreateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'username',
                TextType::class,
                [
                    'required' => true,
                    'attr' => ['class' => 'input'],
                ]
            )
            ->add(
                'plainPassword',
                RepeatedType::class,
                array(
                    'type' => PasswordType::class,
                    'required' => true,
                    'first_options' => ['label' => 'Password', 'attr' => ['class' => 'input'],],
                    'second_options' => ['label' => 'Repeat Password', 'attr' => ['class' => 'input'],],
                )
            )
            ->add(
                'create',
                SubmitType::class,
                [
                    'attr' => ['class' => 'button is-primary'],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }
}