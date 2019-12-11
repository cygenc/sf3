<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\User;
use App\Form\AddressesType;
use App\Form\ChangePasswordType;
use App\Form\ProfileType;
use App\Form\RegisterType;
use App\Form\UsernameType;
use App\Service\User\UserHelper;
use App\Service\User\UserManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{
    /**
     * @Route("/account/profile", name="profile")
     */
    public function profile(EntityManagerInterface $em, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form = $this->createForm(ProfileType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Le profil a été mis à jour.');
            return $this->redirect($request->getUri());
        }

        return $this->render('user/profile.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/account/password", name="password")
     */
    public function password(Request $request, UserManager $userManager)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newPassword = $form->get('newPassword')->getData();
            $userManager->setPassword($this->getUser(), $newPassword);
            $this->addFlash('success', 'Votre mot de passe à bien été changé.');
            return $this->redirect($request->getUri());
        }

        return $this->render('user/change_password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/account/addresses", name="addresses")
     */
    public function addresses(EntityManagerInterface $em, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();

        if (!$user->getAddresses()->getValues()) {
            $address = (new Address)->setDefault(true);
            $user->addAddress($address);
        }

        $form = $this->createForm(AddressesType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Les adresses ont été mise à jour.');
            return $this->redirect($request->getUri());
        }

        return $this->render('user/addresses.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/account/username", name="username")
     */
    public function username(EntityManagerInterface $em, Request $request, UserHelper $userHelper)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();
        $form = $this->createForm(UsernameType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('password')->getData();
            if ($userHelper->isPasswordValid($user, $password)) {
                $em->flush();
                $this->addFlash('success', 'Les identifiants de connexion ont été mis à jour.');
                return $this->redirect($request->getUri());
            } else {
                $this->addFlash('danger', 'Mot de passe incorrect.');
            }
        }

        return $this->render('user/username.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
