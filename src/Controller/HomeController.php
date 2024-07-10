<?php

namespace App\Controller;

use App\BoiteMail\BoiteMail;
use App\Entity\User;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HomeController extends AbstractController
{
    
    /*
     * Messenger 
    #[Route('/home', name: 'app_home')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact =new BoiteMail();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $mail = (new TemplatedEmail())
                     ->to("bb@gmail.com")
                     ->from("p@go.dd")
                     ->htmlTemplate("mail.html.twig")
                     ->context(["form" => ["name"=>"dd", "mail"=>"dhhd", "content"=>"dgghhd"]]);
            $mailer->send($mail);
            return $this->redirectToRoute("/");
        }

        return $this->render('home/index.html.twig', [
            'form' => $form,
        ]);
    }
    */
    
    #[Route(path:"/", name:"home.index")]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $password)
    {
        #$user = new User();
        #$user->setUsername("brutos_rn")->setPassword($password->hashPassword($user,"kabarolo"));
        #$em->persist($user);
        #$em->flush();
        return $this->redirectToRoute("app_article");
    }

}
