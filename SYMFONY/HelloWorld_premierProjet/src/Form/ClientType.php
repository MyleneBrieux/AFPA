<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClientType extends AbstractType
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
        ->add('nom', TextType::class, $this->getConfiguration('Nom','Saisissez le nom du client'))
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
            'data_class' => Client::class,
            // enable/disable CSRF protection for this form
            'csrf_protection' => true,
            // the name of the hidden HTML field that stores the token
            'csrf_field_name' => '_token',
            // an arbitrary string used to generate the value of the token
            // using a different string for each form improves its security
            'csrf_token_id'   => 'client_item',
        ]);
    }
}
