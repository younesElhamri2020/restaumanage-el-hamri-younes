<?php

namespace App\Controller;

use App\Entity\Review;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReviwController extends AbstractController
{

    private $reviewRepository;
    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository=$reviewRepository;

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
        return $this->render("review/form-ajoutreview.html.twig");

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
            return $this->render("review/form-editreview.html.twig");
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
     * @Route("/nouveau_review", name="nouveauReview")
     */
    public function nouveauReview(): Response
    {
        return $this->render('review/nouveauReview.html.twig', [
            'controller_name' => 'ReviewController',
        ]);
    }

    /**
     * @Route("/show/{id}", name="review_show")
     */
    public function show_review($id){
        $review=$this -> getDoctrine()->getRepository(Review::class)->find($id);
        return $this->render('review/show.html.twig',['review' => $review]);
    }

}
