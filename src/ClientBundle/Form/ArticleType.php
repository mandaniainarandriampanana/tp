<?php

namespace ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

class ArticleType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $formValidator = function (FormEvent $event) use ($options) {
            $articleManager = $options['front.manager.article'];
            $form = $event->getForm();
            $results = $articleManager->newArticle($form->getData());
            if ($results->status !== 200) {
                $this->addError($results->error, $form);
            }
        };
        $builder->add('title', null, array(
                    'attr' => array('class' => 'form-control', 'required' => true)))
                ->add('leading', TextareaType::class, array(
                    'required' => false,
                    'attr' => ['class' => 'form-control']))
                ->add('body', TextareaType::class, array(
                    'required' => false,
                    'attr' => ['class' => 'form-control']))
                ->add('slug', null, array(
                    'attr' => array('class' => 'form-control', 'required' => true)))
                ->add('createdBy', null, array(
                    'attr' => array('class' => 'form-group form-control', 'required' => true)))
                ->addEventListener(FormEvents::SUBMIT, $formValidator);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ClientBundle\Objects\Article'
        ));
        $resolver->setRequired('front.manager.article');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'clientbundle_article';
    }

    public function addError($errors, $form) {
        foreach ($errors as $error) {
            $form[$error->field]->addError(new FormError($error->message));
        }
    }

}
