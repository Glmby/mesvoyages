<?php

namespace App\Controller\admin;

use App\Entity\Visite;
use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class AdminVoyagesController extends AbstractController {
    /**
     * @Route ("/admin", name="admin.voyages")
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
     * @Route("admin/suprr/{id}", name="admin.voyage.suppr")
     * @param Visite $visite
     * @return Response
     */
    public function suppr(Visite $visite): Response{
        $this->repository->remove($visite,true);
        return $this->redirectToRoute('admin.voyages');
    }
}

