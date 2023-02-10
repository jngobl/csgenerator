<?php

namespace App\Controller;

use App\GenerateLoadout;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    #[Route('/')]
    public function form(\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $generator = new GenerateLoadout();
        $form = $this->createFormBuilder()
            ->add('save', SubmitType::class, ['label' => 'Senden'])
            ->getForm();

        $form->handleRequest($request);
        return $this->render(
            'form/money.html.twig',
            [
                'data' => $generator->generate(),
                'form' => $form->createView(),
            ]
        );
    }
}
