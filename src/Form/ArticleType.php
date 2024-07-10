<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\DomCrawler\Image as DomCrawlerImage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('create_at', null, [
                'widget' => 'single_text'
            ])
            ->add('thumbnailFile', FileType::class, [
                'mapped'=> false,
                'constraints'=>[new Image()]
            ])
            ->add('category', EntityType::class, [
                'class'=> Category::class,
                'choice_label'=>'name'
            ])
            ->add('slug')
            ->add('name')
            ->add('save', SubmitType::class, [
                'label'=> 'save'
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
