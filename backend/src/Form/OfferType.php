<?php

namespace App\Form;

use App\Dictionary\ActivityStatusDictionary;
use App\Entity\Offer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class OfferType
 * @package App\Form
 */
class OfferType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('link', UrlType::class)
            ->add(
                'status',
                ChoiceType::class,
                [
                    'choices' => [
                        ActivityStatusDictionary::STATUS_ACTIVE => ActivityStatusDictionary::STATUS_ACTIVE,
                        ActivityStatusDictionary::STATUS_ACTIVE => ActivityStatusDictionary::STATUS_INACTIVE,
                    ],
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Offer::class,
            ]
        );
    }
}
