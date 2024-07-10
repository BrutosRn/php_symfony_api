<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                 'constraints' => [new Length(['min' => 5])]
             ]
            )
            ->add("articles", EntityType::class,[
                "class"=> Article::class,
                "choice_label" => "name",
                "multiple" => true,
                "expanded" => false, // Utilisez checkboxes
                "by_reference" => false
            ])
            ->add('description', TextType::class, [
               'required' => true,
                'constraints' => [new Length(['min' => 10])],
            ])
            ->add('save', SubmitType::class,
            [
                'label'=> 'save'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
