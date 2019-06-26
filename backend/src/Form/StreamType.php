<?php
declare(strict_types=1);

namespace App\Form;

use App\Dictionary\ActivityStatusDictionary;
use App\Entity\Offer;
use App\Entity\Stream;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class StreamType
 */
class StreamType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
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
            )
            ->add(
                'status',
                ChoiceType::class,
                [
                    'choices' => [
                        ActivityStatusDictionary::STATUS_ACTIVE => ActivityStatusDictionary::STATUS_ACTIVE,
                        ActivityStatusDictionary::STATUS_INACTIVE => ActivityStatusDictionary::STATUS_INACTIVE,
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
                'data_class' => Stream::class,
            ]
        );
    }
}
