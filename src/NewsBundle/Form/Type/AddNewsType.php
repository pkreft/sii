<?php

namespace NewsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class AddNewsType
 * @package NewsBundle\Form\Type
 */
class AddNewsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction('#')
            ->add('preview', TextType::class, array(
                'label'         => 'Zajawka',
                'required'      => true,
                'constraints'   => array(
                    new NotBlank(array('message' => 'Pole jest wymagane'))
                )
            ))
            ->add('content', TextareaType::class, array(
                'label'         => 'Treść',
                'required'      => true,
                'constraints'   => array(
                    new NotBlank(array('message' => 'Pole jest wymagane'))
                )
            ))
            ->add('important', CheckboxType::class, array(
                'label'         => 'Ważny'
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Zapisz'
            ))
        ;
    }
}