<?php

namespace App\Controller;

use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ProfileController extends Controller
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profil(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Le profil a été mis à jour.');
            return $this->redirect($request->getUri());
        }

        return $this->render('profile.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
