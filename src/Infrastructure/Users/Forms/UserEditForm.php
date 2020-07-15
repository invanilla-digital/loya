<?php

declare(strict_types=1);

namespace App\Infrastructure\Users\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditForm extends AbstractType
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
                'roles',
                ChoiceType::class,
                [
                    'choices' => [
                        'ROLE_CAMPAIGN_ADMIN' => 'ROLE_CAMPAIGN_ADMIN',
                        'ROLE_USER_ADMIN' => 'ROLE_USER_ADMIN',
                        'ROLE_CUSTOMER_ADMIN' => 'ROLE_CUSTOMER_ADMIN',
                        'ROLE_SUPERADMIN' => 'ROLE_SUPERADMIN',
                    ],
                    'expanded' => true,
                    'multiple' => true,
                ]
            )
            ->add(
                'edit',
                SubmitType::class,
                [
                    'attr' => ['class' => 'button is-primary'],
                ]
            );
    }
}