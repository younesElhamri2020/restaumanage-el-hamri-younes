<?php

namespace App\Controller;
use App\Repository\CityRepository;
use App\Repository\RestaurantRepository;
use App\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{


    private $restaurantRepository;
    private $cityRepository;


    public function __construct(RestaurantRepository $restaurantRepository,CityRepository $cityRepository )
    {
        $this->restaurantRepository=$restaurantRepository;
        $this->cityRepository=$cityRepository;

    }
    /**
     * @Route("/restaurants", name="restaurant")
     */
    public function index(): Response
    {
        $restaurants=$this->restaurantRepository->findAll();
        return $this->render('restaurant/index.html.twig', [
            'restaurants' =>  $restaurants
        ]);
    }

    /**
     * @Route("/restaurant", name="restaurant.ajouter", methods={"GET","POST"})
     */
    public function ajouter(Request $request):Response
    {
        if ($request->getMethod() === 'POST') {
            //create object
            $restaurant = new Restaurant();
            $restaurant->setName($request->get('name'));
            $restaurant->setDescription($request->get('description'));
            $restaurant->setCreatedAt(new \DateTime());
            $restaurant->setCityId($this->cityRepository->find($request->get('city')));


            $this->restaurantRepository->store($restaurant);

            //redirect to index
            return $this->redirectToRoute('restaurant');
        }else {
             $citys=$this->cityRepository->findAll();
            return $this->render("restaurant/ajoutrestaurant.html.twig",[
              'citys'=>$citys
            ]);
        }
    }
    /**
     * @Route("/editrestaurant/{id}", name="restaurant.edit", methods={"GET","POST"})
     */
    public function editRestaurant(Request $request,$id): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // chercher le restaurant
            $restaurant=new Restaurant();
            $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);
            // les information de modifier
            $restaurant->setName($request->get('name'));
            $restaurant->setDescription($request->get('description'));
            $restaurant->setCityId($this->cityRepository->find($request->get('city')));
            // modifier le restaurant dans la base de données
            $this->restaurantRepository->edit_restaurant($restaurant);
            return $this->redirectToRoute('restaurant');
        }else{
            $restaurant=$this -> getDoctrine()->getRepository(Restaurant::class)->find($id);
            $citys=$this->cityRepository->findAll();
            return $this->render("restaurant/edit-restaurant.html.twig",[
                     'restaurant'=>$restaurant,
                    'citys'=>$citys
                ]
            );
        }
    }

    /**
     * @Route("/restaurant/delete/{id}" ,name="restaurant.delete")
     */
    public function delete(Request $request, $id) {
        //find the object to delete
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);
        // delete object
        $this->restaurantRepository->deleterestaurant($restaurant);
        return $this->redirectToRoute('restaurant');
    }

    /**
     * @Route("/restaurant/{id}", name="restaurant_show")
     */
    public function show_restaurant($id){
        $restaurant=$this -> getDoctrine()->getRepository(Post::class)->find($id);
        return $this->render('city/show.html.twig',['restaurant' => $restaurant]);
    }




}
