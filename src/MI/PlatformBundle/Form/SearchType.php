<?php

namespace MI\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use MI\PlatformBundle\Repository\CategoryRepository;

class SearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $dateAjout = [];
        $lastYear= date('Y');

        for($firstYear = 2000; $firstYear <= $lastYear; $firstYear++)
        {
            $dateAjout[$firstYear] = $firstYear;
        }


        $builder
            ->add('titre', TextType::class, [
                'required' => false,
                'label' => 'Titre'
            ])
            ->add('date_ajout', ChoiceType::class, [
                    'choices' => $dateAjout,
                    'label' => "Date d'ajout de film",
                    'required' => false,
                    'placeholder'   => 'Sélectionez une année',
                ])
            ->add('category', EntityType::class, [
                'class' => 'MIPlatformBundle:Category',
                'label' => 'Category',
                'choice_label' => 'libelle',
                'placeholder'   => 'Sélectionez une option',
                'required' => false,
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            //'data_class' => 'MI\PlatformBundle\Entity\Film',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mi_platformbundle_search';
    }


}
