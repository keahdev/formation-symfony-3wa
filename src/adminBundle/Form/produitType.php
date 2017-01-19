<?php

namespace adminBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class produitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleFR', TextType::class)
            ->add('descriptionFR', TextareaType::class)
            ->add('titleEN', TextType::class)
            ->add('descriptionEN', TextareaType::class)
            ->add('price', IntegerType::class)
            ->add('quantity', IntegerType::class)
            ->add('image', FileType::class, [
                'data_class' => null// s'il n'avait pas cette ligne il aura une erreur sur data_class 'The form's view data is expected to .....'
            ])
            ->add('marque', EntityType::class, [
                'class' => 'adminBundle\Entity\Brand',
                'choice_label' => 'titre',// la propriété de l'entity brand a afficher ici le titre de la marque
                'placeholder' => '',// le placeholder est vide pour que le select du form affiche un champs vide au debut, le placeholder ici rien avoir avec c                 celui du HTML
                // 'expanded'=>true,//  si true donc ce n'est pas un bouton select mais un bouton radio (plusieurs champs)
                // 'multiple'=>false // si true donc ce n'est pas un bouton select mais une case a coché (plusieurs ligne)
            ])
            ->add('categories', EntityType::class, [
                'class' => 'adminBundle\Entity\Categorie',
                'choice_label' => 'title',// on affiche le titre de la catégorie
                'expanded' => true,
                'multiple' => true
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'adminBundle\Entity\produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_produit';
    }


}
