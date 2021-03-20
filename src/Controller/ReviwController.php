<?php

namespace App\Controller;

use App\Entity\Review;
use App\Repository\RestaurantRepository;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReviwController extends AbstractController
{

    private $reviewRepository;
    private $restaurantRepository;
    private $userRepository;
    public function __construct(ReviewRepository $reviewRepository,RestaurantRepository $restaurantRepository,UserRepository $userRepository)
    {
        $this->reviewRepository=$reviewRepository;
        $this->restaurantRepository=$restaurantRepository;
        $this->userRepository =$userRepository;
    }
    /**
     * @Route("/reviws", name="reviw")
     */
    public function index(): Response
    {
        $reviews=$this->reviewRepository->findAll();
        return $this->render('review/index.html.twig', [
            'reviews' =>  $reviews
        ]);
    }

    /**
     * @Route("/review", name="review.ajouter", methods={"GET","POST"})
     */
    public function ajouterreview(Request $request):Response
    {
        if ($request->getMethod() === 'POST') {
            //create object
            $review = new Review();
            $review->setMessage($request->get('message'));
            $review->setRating($request->get('rating'));
            $review->setRestaurantId($request->get('restaurant'));
            $review->setUserId($request->get('user'));

            $this->reviewRepository->storeReview($review);

            //redirect to index
            return $this->redirectToRoute('reviews');
        }
        else {
            $users=$this->userRepository->findAll();
            $retaurants=$this->restaurantRepository->findAll();
            return $this->render("review/form-ajoutreview.html.twig",[
                'users'=>$users,
                'retaurants'=>$retaurants
            ]);
        }
    }

    /**
     * @Route("/editreview/{id}", name="review.edit", methods={"GET","POST"})
     */
    public function editReview(Request $request,$id): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // chercher le restaurant
            $review=new Review();
            $review = $this->getDoctrine()->getRepository(Review::class)->find($id);
            // les informations de modifier
            $review->setMessage($request->get('message'));
            $review->setRating($request->get('rating'));
            $review->setRestaurantId($request->get('restaurant'));
            $review->setUserId($request->get('user'));

            // modifier le restaurant dans la base de données
            $this->reviewRepository->edit_review($review);
            return $this->redirectToRoute('review');
        }else{
            $review=$this -> getDoctrine()->getRepository(Review::class)->find($id);
            $users=$this->userRepository->findAll();
            $retaurants=$this->restaurantRepository->findAll();
            return $this->render("review/edit-review.html.twig",[
                'review'=>$review,
                'users'=>$users,
                'retaurants'=>$retaurants
            ]);
        }
    }
    /**
     * @Route("/reviews/delete/{id}")
     */
    public function deleteReview(Request $request, $id) {
        //find the object to delete
        $review = $this->getDoctrine()->getRepository(Review::class)->find($id);
        // delete object
        $this->reviewRepository->delete_review($review);
        return $this->redirectToRoute('review');
    }

    /**
     * @Route("/show/{id}", name="review_show")
     */
    public function show_review($id){
        $review=$this -> getDoctrine()->getRepository(Review::class)->find($id);
        return $this->render('review/show.html.twig',['review' => $review]);
    }

}
