<?php

declare(strict_types=1);

namespace App\Infrastructure\Customers\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'required' => true,
                    'attr' => ['class' => 'input'],
                ]
            )
            ->add(
                'surname',
                TextType::class,
                [
                    'required' => true,
                    'attr' => ['class' => 'input'],
                ]
            )
            ->add(
                'personalCode',
                TextType::class,
                [
                    'required' => true,
                    'attr' => ['class' => 'input'],
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'required' => true,
                    'attr' => ['class' => 'input'],
                ]
            )
            ->add(
                'dateOfBirth',
                DateType::class,
                [
                    'required' => true,
                    'input' => 'datetime_immutable'
                ]
            )
            ->add(
                $options['submit_button'] ?? 'submit',
                SubmitType::class,
                [
                    'attr' => ['class' => 'button is-primary']
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefined('submit_button');
    }
}