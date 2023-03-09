<?php

namespace App\Controller\admin;

use App\Entity\Visite;
use App\Form\VisiteType;
use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class AdminVoyagesController extends AbstractController {
    /**
     * @Route ("voyages/admin", name="admin.voyages")
     * @return Response
     */ 
     public function index(): Response{
        $visites=$this->repository->FindAllOrderBy('datecreation','ASC');
        return $this->render("admin/admin.voyages.html.twig",[
            'visites'=>$visites
        ]);
    }
        /**
     * 
     * @var VisiteRepository
     */
    private $repository;
    /**
     * 
     * @param VisiteRepository $repository
     */
    public function __construct(VisiteRepository $repository){
        $this->repository=$repository;
    }
    /**
     * @Route("/admin/suprr/{id}", name="admin.voyage.suppr")
     * @param Visite $visite
     * @return Response
     */
    public function suppr(Visite $visite): Response{
        $this->repository->remove($visite,true);
        return $this->redirectToRoute('admin.voyages');
    }
    /**
     * @Route("/admin/edit/{id}", name="admin.voyage.edit")
     * @param Visite $visite
     * @param Request $request
     * @return Response
     */
    public function edit(Visite $visite, Request $request):Response{
        $formVisite= $this->createForm(VisiteType::class, $visite);
        
        $formVisite->handleRequest($request);
        if($formVisite->isSubmitted()&& $formVisite->isValid()){
            $this->repository->add($visite, true);
            return $this->redirectToRoute('admin.voyages');
        }
        
        return $this->render("admin/admin.voyage.edit.html.twig",[
            'visite'=> $visite,
            'formVisite'=> $formVisite->createView()
        ]);
    }
    /**
     * @Route("/admin/ajout", name="admin.voyage.ajout")
     * @param Request $request
     * @return Response
     */
    
    public function ajout(Request $request):Response{
        $visite= new Visite();
        $formVisite= $this->createForm(VisiteType::class, $visite);
        
        $formVisite->handleRequest($request);
        if($formVisite->isSubmitted()&& $formVisite->isValid()){
            $this->repository->add($visite, true);
            return $this->redirectToRoute('admin.voyages');
        }
        
        return $this->render("admin/admin.voyage.ajout.html.twig",[
            'visite'=> $visite,
            'formVisite'=> $formVisite->createView()
        ]);
    }
}

