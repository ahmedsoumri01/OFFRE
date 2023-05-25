<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(): Response
    {
        // Fetch the counts of offers, users, and reservations from your database or any other source
        $offersCount = 56; // Replace ... with the actual count of offers
        $usersCount = 5; // Replace ... with the actual count of users
        $reservationsCount = 7; // Replace ... with the actual count of reservations

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'offersCount' => $offersCount,
            'usersCount' => $usersCount,
            'reservationsCount' => $reservationsCount,
        ]);
    }

    /**
     * @Route("/admin/profile", name="app_admin_profile")
     */
    public function profile(Request $request): Response
    {
        // Fetch the current admin user or their information from your database
        $admin = $this->getUser(); // Assuming you have configured the user provider correctly

        return $this->render('admin/profile.html.twig', [
            
        ]);
    }
}
