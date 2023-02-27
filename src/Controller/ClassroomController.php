<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Entity\Student;
use App\Repository\StudentRepository;
//use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    #[Route('/afficherclassroom', name: 'afficher_classroom')]
    public function Affichage(ManagerRegistry $doctrine): Response
    {
        $repo=$doctrine->getRepository(Classroom::class);
        $classrooms=$repo->findAll();
        
        return $this->render('Classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
            'classrooms'=>$classrooms
        ]);
    }

    #[Route('/addClassroom/{id}', name: 'addClassroom')]
    public function addClassroom(ManagerRegistry $doctrine){
        $classroom=new Classroom();
        $classroom->setName('test persist');
        $em=$doctrine->getManager;
        $em->persist($classroom);
        $em->flush();
        return $this->redirectToRoute('app_classroom');
    
    }
    #[Route('/updateClassroom/{$id}',name:'update_classroom')]
      public function updateClassroom($id,ManagerRegistry $doctrine)
      {
        $classroom=$doctrine->getRepository(Classroom::class)->find($id);
        $classroom->setName('test update');
        $em=$doctrine->getManager();
        $em->flush();
        return $this->redirectToRoute('app_classroom');
    }
    #[Route('/deleteClassroom/{id}', name: 'delete_classroom')]
    public function deleteClassroom($id,ManagerRegistry $doctrine){
        $classroom=$doctrine->getRepository(Classroom::class)->find($id);
        $em=$doctrine->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute('app_classroom');


    
}

}
