<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\Client;
use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ProduitType extends AbstractType
{

    /**
     * Configuration de base d'un champ de formulaire
     * 
     * @param string $label
     * @param string $placeholder
     * @return array
     * 
     */
    private function getConfiguration($label,$placeholder) {
        return [
                'label' => $label,
                'attr' => [
                        'placeholder' => $placeholder
                    ]
                ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class, $this->getConfiguration('Libellé','Saisissez le type du produit'))
            ->add('prix', MoneyType::class, $this->getConfiguration('Prix','Saisissez le prix (en euros)')) 
            ->add('couleur', TextType::class, $this->getConfiguration('Couleur','Indiquez la couleur du produit')) 
            ->add('categorie', EntityType::class, [
                                                    'class' => Categorie::class,
                                                    'choice_label' => 'designation',
                                                ])
            ->add('save', SubmitType::class, [
                  'label' => 'Valider',
                  'attr' => [
                      'class' => 'btn btn-success'
                  ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
            // enable/disable CSRF protection for this form
            'csrf_protection' => true,
            // the name of the hidden HTML field that stores the token
            'csrf_field_name' => '_token',
            // an arbitrary string used to generate the value of the token
            // using a different string for each form improves its security
            'csrf_token_id'   => 'produit_item',
        ]);
    }
}
