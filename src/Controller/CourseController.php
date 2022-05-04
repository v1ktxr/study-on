<?php

namespace App\Controller;

use App\Entity\Course;
use App\Form\CourseType;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/courses')]
class CourseController extends AbstractController
{
    #[Route('/', name: 'app_course_index', methods: ['GET'])]
    public function index(CourseRepository $courseRepository): Response
    {
        return $this->render('course/index.html.twig', [
            'courses' => $courseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_course_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CourseRepository $courseRepository, ValidatorInterface $validator): Response
    {
        $errors = [];
        $course = new Course();
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $errors = $validator->validate($course);

            if (count($errors) == 0) {
                $courseRepository->add($course);
                return $this->redirectToRoute('app_course_index', [], Response::HTTP_SEE_OTHER);
            }
 
        }

        return $this->renderForm('course/new.html.twig', [
            'course' => $course,
            'form' => $form,
            'errors' => $errors,
        ]);
    }

    #[Route('/{id}', name: 'app_course_show', methods: ['GET'])]
    public function show(Course $course, CourseRepository $courseRepository): Response
    {
        $course->getLessons();
        //$this->getDoctrine()->getManager()->initializeObject($course);
        $courseRepository->findAllLessonsByCourseId($course->getId());
        return $this->render('course/show.html.twig', [
            'course' => $course,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_course_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Course $course, CourseRepository $courseRepository): Response
    {
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $courseRepository->add($course);
            return $this->redirectToRoute('app_course_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('course/edit.html.twig', [
            'course' => $course,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_course_delete', methods: ['POST'])]
    public function delete(Request $request, Course $course, CourseRepository $courseRepository): Response
    {
        $courseRepository->deleteCourseWithLessonsById($course->getId());
        return $this->redirectToRoute('app_course_index', [], Response::HTTP_SEE_OTHER);
    }
}
