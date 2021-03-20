<?php

namespace App\Controller;

use App\Entity\RestaurantPicture;
use App\Repository\RestaurantPictureRepository;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantPictureController extends AbstractController
{
  private $restaurantPictureRepository;
  private $restaurantRepository;
    public function __construct(RestaurantPictureRepository $restaurantPictureRepository,RestaurantRepository $restaurantRepository)
    {

        $this->restaurantPictureRepository=$restaurantPictureRepository;
        $this->restaurantRepository=$restaurantRepository;

    }
    /**
     * @Route("/restaurantpictures", name="restaurant_picture")
     */
    public function index(): Response
    {
        $restaurantPictures=$this->restaurantPictureRepository->findAll();
        return $this->render('restaurantpicture/index.html.twig', [
            'restaurantPictures' =>  $restaurantPictures
        ]);
    }




    /**
     * @Route("/restaurantpicture", name="restaurantpicture.ajouter", methods={"GET","POST"})
     */
    public function ajouter(Request $request):Response
    {
        if ($request->getMethod() === 'POST') {
            //create object
            $restaurantpicture = new RestaurantPicture();
            $restaurantpicture->setFilename($request->get('filename'));
            $restaurantpicture->setRestaurantId($request->get('restaurant'));



            $this->restaurantPictureRepository->storeRestaurantPicture($restaurantpicture);

            //redirect to index
            return $this->redirectToRoute('restaurant_picture');
        }else {
            $restaurants=$this->restaurantRepository->findAll();
            return $this->render("restaurantpicture/ajout-restaurant_picture.html.twig",[
                'restaurants'=>$restaurants
                ]);
        }
    }



    /**
     * @Route("/editrestaurantp/{id}", name="restaurantp.edit", methods={"GET","POST"})
     */
    public function editRestaurantP(Request $request,$id): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // chercher le restaurant
            $restaurantpicture=new RestaurantPicture();
            $restaurantpicture = $this->getDoctrine()->getRepository(RestaurantPicture::class)->find($id);
            // les information de modifier
            $restaurantpicture->setFilename($request->get('filename'));
            $restaurantpicture->setRestaurantId($request->get('restaurant'));
            // modifier le restaurant dans la base de données
            $this->restaurantPictureRepository->edit_RestaurantPicture($restaurantpicture);
            return $this->redirectToRoute('restaurant_picture');
        }else{
            $restaurantpicture=$this -> getDoctrine()->getRepository(RestaurantPicture::class)->find($id);
            $restaurants=$this->restaurantRepository->findAll();
            return $this->render("restaurantpicture/edit-restaurant_picture.html.twig");
        }
    }



    /**
     * @Route("/restaurantpicture/delete/{id}",name="restaurantpicture")
     */
    public function delete(Request $request, $id) {
        //find the object to delete
        $restaurantpicture = $this->getDoctrine()->getRepository(RestaurantPicture::class)->find($id);
        // delete object
        $this->restaurantPictureRepository->deleteRestaurantPicture($restaurantpicture);
        return $this->redirectToRoute('restaurant_picture');
    }

    /**
     * @Route("/restaurantpicture/{id}", name="restaurantpicture_show")
     */
    public function show_restaurantpicture($id){
        $restaurantpicture=$this -> getDoctrine()->getRepository(RestaurantPicture::class)->find($id);
        return $this->render('restaurantpicture/show.html.twig',['restaurantpicture' => $restaurantpicture]);
    }



}
