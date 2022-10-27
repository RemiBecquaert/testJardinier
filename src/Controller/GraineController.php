<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Graine;
use App\Form\GraineType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;


class GraineController extends AbstractController
{
    #[Route('/private-liste-graines', name: 'app_liste-graines')]
    public function listeGraines(ManagerRegistry $doctrine, Request $request): Response
    {
        $em = $doctrine->getManager();
        if($request->get('id') != null){
            $laGraines = $doctrine->getRepository(Graine::class)->find($request->get('id'));
            $em->remove($laGraines);
            $em->flush();
            $this->addFlash('danger','Graine supprimée !');
            return $this->redirectToRoute('app_liste-graines');
        }

        $repoGraine = $doctrine->getRepository(Graine::class);
        $graines = $repoGraine->findAll();
        return $this->render('base/listeGraines.html.twig', ['graines'=>$graines]);
    }


    #[Route('/private-ajout-graines', name: 'app_ajout-graines')]
    public function ajoutGraines(Request $request, ManagerRegistry $doctrine): Response
    {
        $graine = new Graine();
        $form = $this->createForm(GraineType::class, $graine);

        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isSubmitted()&&$form->isValid()){
                $em = $doctrine->getManager();
                $em->persist($graine);
                $em->flush();
                $this->addFlash('notice','La graine a été ajoutée !');
                return $this->redirectToRoute('app_liste-graines');
            }
        }
        return $this->render('base/ajoutGraines.html.twig', ['form' => $form->createView()]);
    }

}
