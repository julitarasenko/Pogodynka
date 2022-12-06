<?php

namespace App\Form;

use App\Entity\City;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city_name')
            ->add('country_name', ChoiceType::class, [
                'choices' => [
                    'Albania' => 'AL',
                    'Austria' => 'AT',
                    'Belgia' => 'BE',
                    'Białoruś' => 'BY',
                    'Bośnia i Hercegowina' => 'BiH',
                    'Brazylia' => 'BR',
                    'Bułgaria' => 'BG',
                    'Chorwacja' => 'HR',
                    'Czarnogóra' => 'MNE',
                    'Czechosłowacja' => 'CS',
                    'Czechy' => 'CZ',
                    'Dania' => 'DK',
                    'Estonia' => 'EST',
                    'Finlandia' => 'FI',
                    'Francja' => 'FR',
                    'Gibraltar' => 'GIB',
                    'Grecja' => 'GR',
                    'Hiszpania' => 'ES',
                    'Holandia' => 'NL',
                    'Irlandia' => 'IRL',
                    'Islandia' => 'IS',
                    'Izrael' => 'IL',
                    'Jugosławia' => 'YU',
                    'Kanada' => 'CA',
                    'Lichtenstein' => 'LI',
                    'Litwa' => 'LT',
                    'Luxemburg' => 'LU',
                    'Łotwa' => 'LV',
                    'Macedonia' => 'MK',
                    'Malezja' => 'MY',
                    'Malta' => 'MT',
                    'Mołdawia' => 'MD',
                    'Monako' => 'MC',
                    'Niemcy' => 'DE',
                    'Norwegia' => 'NO',
                    'Polska' => 'PL',
                    'Portugalia' => 'PT',
                    'Rumunia' => 'RO',
                    'San Marino' => 'SM',
                    'Serbia' => 'SRB',
                    'Słowacja' => 'SK',
                    'Słowenia' => 'SLO',
                    'Szwajcaria' => 'CH',
                    'Szwecja' => 'SE',
                    'Ukraina' => 'UA',
                    'USA' => 'USA',
                    'Turcja' => 'TR',
                    'Węgry' => 'HU',
                    'Wielka Brytania' => 'GB',
                    'Włochy' => 'IT',
                ],
            ])
            ->add('latitude')
            ->add('longitude')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => City::class,
        ]);
    }
}
