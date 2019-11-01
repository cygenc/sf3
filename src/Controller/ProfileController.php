<?php

namespace App\Controller;

use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ProfileController extends Controller
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profil(EntityManagerInterface $em, Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Le profil a été mis à jour.');
            return $this->redirect($request->getUri());
        }

        return $this->render('profile.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
