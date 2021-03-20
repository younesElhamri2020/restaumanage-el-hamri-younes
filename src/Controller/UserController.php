<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CityRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    private $userRepository;
    private $cityRepository;
    public function __construct(UserRepository $userRepository,CityRepository $cityRepository)
    {
        $this->userRepository =$userRepository;
        $this->cityRepository=$cityRepository;
    }
    /**
     * @Route("/users", name="user")
     */
    public function index(): Response
    {
        $users=$this->userRepository->findAll();
        return $this->render('user/index.html.twig', [
            'users' =>  $users
        ]);
    }


    /**
     * @Route("/user", name="user.ajouter", methods={"GET","POST"})
     */
    public function ajouteruser(Request $request):Response
    {
        if ($request->getMethod() === 'POST') {
            //create object
            $user= new User();
            $user->setUsername($request->get('username'));
            $user->setPassword($request->get('password'));
            $user->setCityId($request->get('city'));

            $this->userRepository->storeUser($user);

            //redirect to index
            return $this->redirectToRoute('user');
        }else {
            $citys=$this->cityRepository->findAll();
            return $this->render("user/ajout-user.html.twig",[
                'citys'=>$citys
            ]);
        }
    }



    /**
     * @Route("/edituser/{id}", name="user.edit", methods={"GET","POST"})
     */
    public function editUser(Request $request,$id): Response
    {
        if ($request->getMethod() === 'POST') {
            // chercher le restaurant
            $user = new User();
            $user = $this->getDoctrine()->getRepository(User::class)->find($id);
            // les informations de modifier
            $user->setUsername($request->get('username'));
            $user->setPassword($request->get('password'));
            $user->setCityId($request->get('city'));

            // modifier le restaurant dans la base de données
            $this->userRepository->edit_User($user);
            return $this->redirectToRoute('user');
        } else {
            $user=$this -> getDoctrine()->getRepository(User::class)->find($id);
            $citys=$this->cityRepository->findAll();
            return $this->render("user/edit-user.html.twig",[
                'user'=>$user,
                'citys'=>$citys
            ]);
        }
    }

        /**
         * @Route("/user/delete/{id}")
         */
        public function deleteUser(Request $request, $id) {
        //find the object to delete
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        // delete object
        $this->userRepository->delete_User($user);
        return $this->redirectToRoute('user');
    }

    /**
     * @Route("/show/{id}", name="user_show")
     */
    public function show_user($id){
        $user=$this -> getDoctrine()->getRepository(User::class)->find($id);
        return $this->render('city/show.html.twig',[
            'user' => $user
        ]);
    }



}
