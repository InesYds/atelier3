<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Repository\ClassroomRepository;
//use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class StudentController extends AbstractController
{
    //#[Route('/student', name: 'app_student')]
    //public function index(StudentRepository $repo): Response
    //{
      //  $students=$repo->findAll();
        //return $this->render('student/index.html.twig', [
          //  'controller_name' => 'StudentController',
            //'students'=>$students
        //]);
    //}

    #[Route('/student', name: 'app_student')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repo=$doctrine->getRepository(Student::class);
        $students=$repo->findAll();
        
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
            'students'=>$students
        ]);
    }
    #[Route('/deleteStudent/{id}', name: 'delete_student')]
    public function deleteStudent($id,ManagerRegistry $doctrine){
        $student=$doctrine->getRepository(Student::class)->find($id);
        $em=$doctrine->getManager();
        $em->remove($student);
        $em->flush();
        return $this->redirectToRoute('app_student');


    
}
#[Route('/deleteStudent/{id}', name: 'addStudent')]
    public function addStudent(ManagerRegistry $doctrine){
        $student=new Student();
        $student->setUsername('test persist');
        $student->setEmail('persist@test.com');
        $em=$doctrine->getManager;
        $em->persist($student);
        $em->flush();
        return $this->redirectToRoute('app_student');






    }
}
