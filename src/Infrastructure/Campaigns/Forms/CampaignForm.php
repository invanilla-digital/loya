<?php

declare(strict_types=1);

namespace App\Infrastructure\Campaigns\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampaignForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    'required' => true,
                    'attr' => ['class' => 'input'],
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'required' => true,
                    'attr' => ['class' => 'input'],
                ]
            )
            ->add(
                'startDate',
                DateTimeType::class,
                [
                    'required' => true,
                    'input' => 'datetime_immutable'
                ]
            )
            ->add(
                'endDate',
                DateTimeType::class,
                [
                    'required' => true,
                    'input' => 'datetime_immutable'
                ]
            )->add(
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