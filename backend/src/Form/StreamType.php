<?php

namespace App\Form;

use App\Entity\Offer;
use App\Entity\Stream;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class StreamType
 * @package App\Form
 */
class StreamType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('link')
            ->add(
                'user',
                EntityType::class,
                [
                    'class' => User::class,
                ]
            )
            ->add(
                'offer',
                EntityType::class,
                [
                    'class' => Offer::class,
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
                'data_class' => Stream::class,
            ]
        );
    }
}
