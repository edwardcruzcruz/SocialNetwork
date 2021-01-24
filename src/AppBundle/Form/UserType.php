<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
#estas clases se van a encargar de generar los respectivos y
#diferentes inputs de nuestro formulario
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name', TextType::class,array(
                    #cambiar nombre del campo
                    'label' => 'Nombre',
                    #colocando al campo como requerido en el form
                    'required' => 'required',
                    #configurando las clases css
                    'attr' => array (
                        'class' => 'form-name form-control'
                    )
                ))
                ->add('surname', TextType::class,array(
                    #cambiar nombre del campo
                    'label' => 'Apellido',
                    #colocando al campo como requerido en el form
                    'required' => 'required',
                    #configurando las clases css
                    'attr' => array (
                        'class' => 'form-surname form-control'
                    )
                ))
                ->add('nick', TextType::class,array(
                    #cambiar nombre del campo
                    'label' => 'Apodo',
                    #colocando al campo como requerido en el form
                    'required' => 'required',
                    #configurando las clases css
                    #--------------------------------------------------------------->
                    #nick-input dentro de css nos servira en js para saber si hay otro
                    #nick registrado y pedirle al usuario que ingrese otro
                    'attr' => array (
                        'class' => 'form-nick form-control'
                    )
                ))
                ->add('email', EmailType::class,array(
                    #cambiar nombre del campo
                    'label' => 'Correo electronico',
                    #colocando al campo como requerido en el form
                    'required' => 'required',
                    #configurando las clases css
                    'attr' => array (
                        'class' => 'form-email form-control'
                    )
                ))
                ->add('bio', TextareaType::class,array(
                    #cambiar nombre del campo
                    'label' => 'Biografia',
                    #colocando al campo como requerido en el form
                    'required' => false,
                    #configurando las clases css
                    'attr' => array (
                        'class' => 'form-bio form-control'
                    )
                ))
                ->add('image', FileType::class,array(
                    #cambiar nombre del campo
                    'label' => 'Foto',
                    #colocando al campo como requerido en el form
                    'required' => false,
                    'data_class' => null,
                    #configurando las clases css
                    'attr' => array (
                        'class' => 'form-image form-control'
                    )
                ))
                ->add('Guardar', SubmitType::class, array(
                    "attr"=> array(
                        "class"=>"form-submit btn btn-success"
                    )
                ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backendbundle_user';
    }


}
