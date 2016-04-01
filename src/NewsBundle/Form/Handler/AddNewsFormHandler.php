<?php

namespace NewsBundle\Form\Handler;

use NewsBundle\Entity\News;
use NewsBundle\Form\Type\AddNewsType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactory;
use Doctrine\ORM\EntityManager;

/**
 * Class AddNewsFormHandler
 * @package NewsBundle\Form\Handler
 */
class AddNewsFormHandler
{
    /**
     * @var FormFactory
     */
    private $formFactory;

    /**
     * @var Form
     */
    private $form;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param FormFactory $formFactory
     * @param EntityManager $entityManager
     */
    public function __construct(FormFactory $formFactory,
                                EntityManager $entityManager)
    {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
    }

    /**
     * @param News $news
     * @param Request   $request
     *
     * @return bool
     */
    public function handle(News $news, Request $request)
    {
        $this->form = $this->formFactory->create(AddNewsType::class, $news);
        $this->form->handleRequest($request);

        if ( $this->form->isValid() ) {
            $this->entityManager->persist($news);
            $this->entityManager->flush();

            return true;
        }

        return false;
    }

    /**
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }
}