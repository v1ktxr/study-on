<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Course;
use App\Form\LessonType;
use App\Repository\LessonRepository;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/lessons')]
class LessonController extends AbstractController
{
    #[Route('/', name: 'app_lesson_index', methods: ['GET'])]
    public function index(LessonRepository $lessonRepository): Response
    {
        return $this->render('lesson/index.html.twig', [
            'lessons' => $lessonRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_lesson_new', methods: ['GET', 'POST'])]
    public function new(string $course_id, Request $request, LessonRepository $lessonRepository, CourseRepository $courseRepository, ValidatorInterface $validator): Response
    {
        $errors = [];
        $lesson = new Lesson();
        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        $course = $courseRepository->findById($course_id);
        $lesson->setCourse($course);

        if ($form->isSubmitted() && $form->isValid()) {


            $errors = $validator->validate($lesson);

            if (count($errors) == 0) {
                $lessonRepository->add($lesson);
                return $this->redirectToRoute('app_course_show', ['id' => $course_id], Response::HTTP_SEE_OTHER);
            }

        }

        return $this->renderForm('lesson/new.html.twig', [
            'lesson' => $lesson,
            'form' => $form,
            'course' => $course,
            'errors' => $errors,
        ]);
    }

    #[Route('/{id}', name: 'app_lesson_show', methods: ['GET'])]
    public function show(Lesson $lesson): Response
    {
        $lesson->getCourse();
        return $this->render('lesson/show.html.twig', [
            'lesson' => $lesson,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lesson_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lesson $lesson, LessonRepository $lessonRepository): Response
    {
        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lessonRepository->add($lesson);
            return $this->redirectToRoute('app_lesson_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lesson/edit.html.twig', [
            'lesson' => $lesson,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lesson_delete', methods: ['POST'])]
    public function delete(Request $request, Lesson $lesson, LessonRepository $lessonRepository): Response
    {
        
        //$lessonRepository->remove($lesson);
        $lessonRepository->deleteById($lesson->getId());
        return $this->redirectToRoute('app_course_show', ['id' => $lesson->getCourse()->getId()], Response::HTTP_SEE_OTHER);
    }
}
