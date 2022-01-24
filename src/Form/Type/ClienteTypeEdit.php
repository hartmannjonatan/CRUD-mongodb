<?php

namespace App\Form\Type;

use App\Document\Cliente;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClienteTypeEdit extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(child:'nome')
            ->add('genero', ChoiceType::class, [
                'choices' => [
                    'Masculino' => 'Masculino',
                    'Feminino' => 'Feminino',
                    'Não informar' => 'Não informar'
                ],
                'expanded' => true,
                'multiple' => false
            ])
            ->add('dataNasc', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('cpf', TextType::class, [
                'attr'=> ['data-mask' => '000.000.000-00']
            ])
            ->add('telefone', TelType::class, [
                'attr' => [
                    'data-mask' => '(00) 9 0000-0000'
                ]
            ])
            ->add('notif_whats', ChoiceType::class, [
                'choices' => [
                    'Quero receber notificações pelo whatsapp' => true,
                    'Não quero receber notificações pelo whatsapp' => false
                ],
                'expanded' => true,
                'multiple' => false
            ])
            ->add(child:'email')
            ->add('emails_promocionais', ChoiceType::class, [
                'choices' => [
                    'Quero receber emails promocionais' => true,
                    'Não quero receber promoções em meu email' => false
                ],
                'expanded' => true,
                'multiple' => false
            ])
            ->add('senha', PasswordType::class)
            ->add('save', SubmitType::class, ['label' => 'Enviar'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cliente::class,
        ]);
    }
}