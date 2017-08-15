<?php

namespace MI\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use MI\PlatformBundle\Repository\CategoryRepository;

class FilmType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $pattern = 'b%';
        $builder
            ->add('titre', TextType::class)
            ->add('description', TextareaType::class)
            ->add('image', ImageType::class)
            ->add('categories', EntityType::class, array(
                'class'         => 'MIPlatformBundle:Category',
                'choice_label'  => 'libelle',
                'multiple'      => true,
                'placeholder'   => 'Choose an option',
                'query_builder' => function(CategoryRepository  $cr) use($pattern){
                    return $cr->getLikeQueryBuilder($pattern);
                },
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MI\PlatformBundle\Entity\Film'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mi_platformbundle_film';
    }


}
