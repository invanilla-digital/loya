<?php

declare(strict_types=1);

namespace App\Infrastructure\Users\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserCreateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add(
                'password_confirmation',
                PasswordType::class,
                [
                    'mapped' => false,
                ]
            )
            ->add('create', SubmitType::class);
    }
}