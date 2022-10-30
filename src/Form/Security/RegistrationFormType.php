<?php

namespace App\Form\Security;

use App\Entity\Security\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre nom de famille'
                ],
                'row_attr' => [
                    'class' => 'pt-3 col-sm-6 col-12'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre prénom'
                ],
                'row_attr' => [
                    'class' => 'pt-3 col-sm-6 col-12'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
                'attr' => [
                    'placeholder' => 'email@gmail.com'
                ],
                'constraints' => [
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Votre email ne doit pas dépasser {{ limit }} caractères !'
                    ])
                ],
                'row_attr' => [
                    'class' => 'pt-3'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux mots de passes doivent correspondre !',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Tapez votre mot de passe'
                    ],
                    'constraints' => [
                        new Length([
                            'min' => 8,
                            'max' => 255,
                            'minMessage' => 'Votre mot de passe doit contenir plus de {{ limit }} caractères',
                            'maxMessage' => 'Votre mot de passe doit contenir moins de {{ limit }} caractères'
                        ])
                    ],
                    'row_attr' => [
                        'class' => 'pt-3 col-sm-6 col-12'
                    ]
                ],
                'second_options' => [
                    'label' => 'Tapez le mot de passe à nouveau',
                    'attr' => [
                        'placeholder' => 'Tapez à nouveau votre mot de passe'
                    ],
                    'constraints' => [
                        new Length([
                            'min' => 8,
                            'max' => 255,
                            'minMessage' => 'Votre mot de passe doit contenir plus de {{ limit }} caractères',
                            'maxMessage' => 'Votre mot de passe doit contenir moins de {{ limit }} caractères'
                        ])
                    ],
                    'row_attr' => [
                        'class' => 'pt-3 col-sm-6 col-12'
                    ]
                ]
            ])
            ->add('birthday', BirthdayType::class, [
                'label' => 'Date de naissance',
                'required' => true,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'row_attr' => [
                    'class' => 'pt-3 col-sm-6 col-12'
                ]
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Sexe',
                'required' => true,
                'choices' => [
                    'Homme' => 0,
                    'Femme' => 1
                ],
                'expanded' => true,
                'multiple' => false,
                'row_attr' => [
                    'class' => 'pt-3 col-sm-6 col-12'
                ]
            ])
            ->add('job', ChoiceType::class, [
                'label' => 'Métier',
                'required' => true,
                'placeholder' => 'Choisissez votre métier',
                'choices' => [
                    "Agriculture" => [
                        'Jardinier / Paysagiste' => 'Jardinier / Paysagiste',
                        'Agriculteur' => 'Agriculteur',
                        'Exploitation' => 'Exploitation'
                    ],
                    "Armée / Sécurité" => [
                        'Agent de sécurité' => 'Agent de sécurité',
                        'Gendarme / Policier' => 'Gendarme / Policier',
                        'Pompier' => 'Pompier',
                        'Contrôleur' => 'Contrôleur',
                        'Douanier' => 'Douanier',
                        'Militaire' => 'Militaire'
                    ],
                    "Arts / Culture" => [
                        'Bijoutier' => 'Bijoutier',
                        'Cordonnier' => 'Cordonnier',
                        'Couturier' => 'Couturier',
                        'Designer' => 'Designer',
                        'Horloger' => 'Horloger',
                        'Journaliste' => 'Journaliste',
                        'Bibliothécaire' => 'Bibliothécaire'
                    ],
                    "Audiovisuel / Communication" => [
                        'Animateur' => 'Animateur',
                        'Comédien' => 'Comédien'
                    ],
                    "Bâtiment" => [
                        'Électricien' => 'Électricien',
                        'Plombier' => 'Plombier',
                        'Couvreur' => 'Couvreur',
                        'Maçon' => 'Maçon',
                        'Mécanicien' => 'Mécanicien',
                        'Menuisier' => 'Menuisier',
                        'Peintre' => 'Peintre'
                    ],
                    "Commerce" => [
                        'Caissier' => 'Caissier',
                        'Commercial' => 'Commercial'
                    ],
                    "Droit / Économie / Gestion" => [
                        'Avocat' => 'Avocat',
                        'Notaire' => 'Notaire',
                        'Juges' => 'Juges',
                        'Comptable' => 'Comptable',
                        'Recruteur' => 'Recruteur'
                    ],
                    "Enseignement" => [
                        'Professeur' => 'Professeur',
                        'Éducateur' => 'Éducateur'
                    ],
                    "Hôtellerie / Restauration / Tourisme" => [
                        'Barman' => 'Barman',
                        'Serveur' => 'Serveur',
                        'Réceptionniste' => 'Réceptionniste',
                        'Guide' => 'Guide'
                    ],
                    "Industrie" => [
                        'Chaudronnier' => 'Chaudronnier',
                        'Soudeur' => 'Soudeur',
                        'Électromécanicien' => 'Électromécanicien'
                    ],
                    "Informatique" => [
                        'Développeur' => 'Développeur',
                        'Cybersécurité' => 'Cybersécurité',
                        'Administrateur réseau' => 'Administrateur réseau',
                        'Analyste' => 'Analyste'
                    ],
                    "Santé" => [
                        'Médecin' => 'Médecin',
                        'Pharmacien' => 'Pharmacien',
                        'Chirurgien' => 'Chirurgien',
                        'Chercheur' => 'Chercheur',
                        'Infirmier' => 'Infirmier'
                    ],
                    "Sport" => [
                        'Entraineur' => 'Entraineur',
                        'Sportif professionnel' => 'Sportif professionnel'
                    ]
                ],
                'row_attr' => [
                    'class' => 'pt-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
