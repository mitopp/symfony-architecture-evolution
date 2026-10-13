<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Guest;
use App\Form\Data\GuestRegistrationData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @extends AbstractType<Guest>
 */
final class GuestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Dein Name',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ich bin dabei!',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GuestRegistrationData::class,
        ]);
    }
}
