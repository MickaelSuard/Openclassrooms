<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Editor;
use App\Enum\BookStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('dateOfBirth', DateType::class, [
                'input' => 'datetime_immutable',
                'widget' => 'single_text',
                'label' => 'Date de naissance',
            ])
            ->add('dateOfDeath', DateType::class, [
                'label' => 'Date de décès',
                'input' => 'datetime_immutable',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('nationality', TextType::class, [
                'label' => 'Nationalité',
                'required' => false,
            ])
            ->add('books', EntityType::class, [
                'label' => 'Livre',
                'class' => Book::class,
                'choice_label' => 'title',
                'multiple' => true,
                'required' => false,
            ])
            ->add('certification', CheckboxType::class,[
                'mapped' => false,
                'label' => "Je certifice de l'exactitude des informations fournies",
                'constraints' => [
                    new Assert\IsTrue(message : "Vous devez cocher la case pour ajouter un auteur"),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}