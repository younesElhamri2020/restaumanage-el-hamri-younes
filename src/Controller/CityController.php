<?php

namespace App\Controller;
use App\Entity\City;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
   private $cityRepository;
    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository=$cityRepository;

    }
    /**
     * @Route("/citys", name="city")
     */
    public function index(): Response
    {
        $citys=$this->cityRepository->findAll();
        return $this->render('city/index.html.twig', [
            'citys' =>  $citys
        ]);
    }

    /**
     * @Route("/city", name="city.ajouter", methods={"GET","POST"})
     */
    public function ajoutercity(Request $request):Response
    {
        if ($request->getMethod() === 'POST') {
            //create object
            $city = new City();
            $city->setName($request->get('name'));
            $city->setZipcode($request->get('zipcode'));


            $this->cityRepository->storeCity($city);

            //redirect to index
            return $this->redirectToRoute('city');
        }
        return $this->render("restaurant/form-ajoutcity.html.twig");

    }
    /**
     * @Route("/nouveau_city", name="nouveauCity")
     */
    public function nouveauCity(): Response
    {
        return $this->render('city/nouveauCity.html.twig', [
            'controller_name' => 'CityController',
        ]);
    }
    /**
     * @Route("/editcity/{id}", name="city.edit", methods={"GET","POST"})
     */
    public function editCity(Request $request,$id): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // chercher le restaurant
            $city=new City();
            $city = $this->getDoctrine()->getRepository(City::class)->find($id);
            // les informations de modifier

            $city->setName($request->get('name'));
            $city->setZipcode($request->get('zipcode'));

            // modifier le restaurant dans la base de données
            $this->cityRepository->edit_city($city);
            return $this->redirectToRoute('city');
        }else{
            return $this->render("city/form-editcity.html.twig");
        }
    }

    /**
     * @Route("/city/delete/{id}")
     * @Method({"DELETE"})
     */
    public function deleteCity(Request $request, $id) {
        //find the object to delete
        $city = $this->getDoctrine()->getRepository(City::class)->find($id);
        // delete object
        $this->cityRepository->delete_city($city);
        return $this->redirectToRoute('city');
    }
    /**
     * @Route("/show/{id}", name="city_show")
     */
    public function show_city($id){
        $city=$this -> getDoctrine()->getRepository(Post::class)->find($id);
        return $this->render('city/show.html.twig',['city' => $city]);
    }

}
