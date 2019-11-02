<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profil(EntityManagerInterface $em, Request $request)
    {
        $user = $this->getUser();

        if (!$user->getAddresses()->getValues()) {
            $user->addAddress(new Address);
        }

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
