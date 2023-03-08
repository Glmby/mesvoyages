<?php



namespace App\Controller;

use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



class VoyagesController extends AbstractController {
    /**
     * @Route ("/voyages", name="voyages")
     * @return Response
     */
    public function index(): Response{
        $visites=$this->repository->FindAllOrderBy('datecreation','ASC');
        return $this->render("pages/voyages.html.twig",[
            'visites'=>$visites
        ]);
    }
    /**
     * @Route("/voyages/tri/{champ}/{ordre}", name="voyages.sort")
     * @param type $champ
     * @param type $ordre
     * @return Response
     */
    public function sort(string $champ, $ordre): Response{
        $visites=$this->repository->findAllorderBy($champ, $ordre);
        return $this->render("pages/voyages.html.twig",[
            'visites'=>$visites
        ]);
    }
    /**
     * @Route("/voyages/recherche/{champ}", name="voyages.findallequal")
     * @param type $champ
     * @param Resquest $request
     * @return Response
     */
    public function FindAllEqual($champ, Request $request):Response{
        $valeur=$request->get("recherche");
        $visites=$this->repository->findByEqualValue($champ,$valeur);
        return $this->render("pages/voyages.html.twig",[
            'visites'=>$visites
        ]);
    }
     /**
     * @Route("/voyages/voyage/{id}", name="voyages.showone")
     * @param type $id
     * @return Response
     */
    public function showOne($id):Response{
        $visite=$this->repository->find($id);
        return $this->render("pages/voyage.html.twig",[
            'visite'=>$visite
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
}

