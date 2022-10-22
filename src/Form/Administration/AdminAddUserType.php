<?php

namespace App\Form\Administration;

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

class AdminAddUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Nom de famille de l\'utilisateur'
                ],
                'row_attr' => [
                    'class' => 'pt-3 col-sm-6 col-12'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Prénom de l\'utilisateur'
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
                        'maxMessage' => 'l\'email ne doit pas dépasser {{ limit }} caractères !'
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
                        'placeholder' => 'Tapez le mot de passe'
                    ],
                    'constraints' => [
                        new Length([
                            'min' => 8,
                            'max' => 255,
                            'minMessage' => 'Le mot de passe doit contenir plus de {{ limit }} caractères',
                            'maxMessage' => 'Le mot de passe doit contenir moins de {{ limit }} caractères'
                        ])
                    ],
                    'row_attr' => [
                        'class' => 'pt-3 col-sm-6 col-12'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmer le mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmer votre mot de passe'
                    ],
                    'constraints' => [
                        new Length([
                            'min' => 8,
                            'max' => 255,
                            'minMessage' => 'Le mot de passe doit contenir plus de {{ limit }} caractères',
                            'maxMessage' => 'Le mot de passe doit contenir moins de {{ limit }} caractères'
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
                    'class' => 'pt-3 col-sm-4 col-12'
                ]
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Pays de l\'utilisateur'
                ],
                'row_attr' => [
                    'class' => 'pt-3 col-sm-4 col-12'
                ]
            ])
            ->add('region', TextType::class, [
                'label' => 'Région',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Région de l\'utilisateur'
                ],
                'row_attr' => [
                    'class' => 'pt-3 col-sm-4 col-12'
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
                    'class' => 'pt-3'
                ]
            ])
            ->add('job', ChoiceType::class, [
                'label' => 'Métier',
                'required' => true,
                'placeholder' => 'Choisissez le métier de l\'utilisateur',
                'choices' => [
                    'Administration' => [
                        'test1' => 'test1',
                        'test2' => 'test2'
                    ],
                    "Agriculture" => [
                        'test3' => 'test3',
                        'test4' => 'test4'
                    ],
                    "Armée / Sécurité" => [
                        'test5' => 'test5',
                        'test6' => 'test6'
                    ],
                    "Arts / Culture" => [
                        'test7' => 'test7',
                        'test8' => 'test8'
                    ],
                    "Audiovisuel / Communication" => [
                        'test9' => 'test9',
                        'test10' => 'test10'
                    ],
                    "Batiment" => [
                        'test11' => 'test11',
                        'test12' => 'test12'
                    ],
                    "Commerce" => [
                        'test13' => 'test13',
                        'test14' => 'test14'
                    ],
                    "Droit / Économie / Gestion" => [
                        'test15' => 'test15',
                        'test16' => 'test16'
                    ],
                    "Énergie / Environnement" => [
                        'test17' => 'test17',
                        'test18' => 'test18'
                    ],
                    "Enseignement" => [
                        'test19' => 'test19',
                        'test20' => 'test20'
                    ],
                    "Hôtellerie / Restauration / Tourisme" => [
                        'test21' => 'test21',
                        'test22' => 'test22'
                    ],
                    "Industrie" => [
                        'test23' => 'test23',
                        'test24' => 'test24'
                    ],
                    "Informatique" => [
                        'test25' => 'test25',
                        'test26' => 'test26'
                    ],
                    "Santé" => [
                        'test27' => 'test27',
                        'test28' => 'test28'
                    ],
                    "Sport" => [
                        'test29' => 'test29',
                        'test30' => 'test30'
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
