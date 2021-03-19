<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository =$userRepository;

    }
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
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
        }
        return $this->render("user/form-ajoutuser.html.twig");

    }

    /**
     * @Route("/nouveau_user", name="nouveauUser")
     */
    public function nouveauUser(): Response
    {
        return $this->render('user/nouveauUser.html.twig', [
            'controller_name' => 'UserController',
        ]);
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
            return $this->render("user/form-edituser.html.twig");
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
        return $this->render('city/show.html.twig',['user' => $user]);
    }



}
