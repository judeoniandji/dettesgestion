<?php
// src/Form/DetteType.php
namespace App\Form;

use App\Entity\Dette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('montant', NumberType::class, [
                'label' => 'Montant'
            ])
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'En attente' => 'en_attente',
                    'Réglée' => 'reglee',
                    'Annulée' => 'annulee',
                ],
                'label' => 'Statut'
            ])
            ->add('save', SubmitType::class, ['label' => 'Créer Dette']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dette::class,
        ]);
    }
}
