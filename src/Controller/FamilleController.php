<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Famille;
use App\Form\FamilleType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class FamilleController extends AbstractController
{
    #[Route('/private-ajout-famille', name: 'app_ajout-famille')]
    public function ajoutFamille(Request $request, ManagerRegistry $doctrine): Response
    {
        $famille = new Famille();
        $form = $this->createForm(FamilleType::class, $famille);

        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isSubmitted()&&$form->isValid()){
                $em = $doctrine->getManager();
                $em->persist($famille);
                $em->flush();
                $this->addFlash('notice','La famille de graine a été ajoutée !');
                return $this->redirectToRoute('app_ajout-famille');
            }
        }
        return $this->render('famille/ajoutFamille.html.twig', ['form' => $form->createView()]);
    }
}
