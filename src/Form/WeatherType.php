<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Weather;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeatherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('temperature')
            ->add('image_id')
            ->add('date')
            ->add('time')
            ->add('temperature_feel')
            ->add('sunrise')
            ->add('sunset')
            ->add('wind_speed')
            ->add('precipitation')
            ->add('humidity')
            ->add('pressure')
            ->add('city', EntityType::class, [
                'class' => City::class,
                'mapped' => true,
                'choice_label' => 'city_name',
                'choice_value' => 'id'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Weather::class,
        ]);
    }
}
