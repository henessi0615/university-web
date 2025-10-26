<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\TeacherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class GetTeacherController extends AbstractController
{
    public function __construct(
        private readonly TeacherRepository $teacherRepository,
    ) {
    }

    #[Route('/api/teachers/{id}', name: 'get_teacher_data', methods: ['GET'])]
    public function getTeacherData(int $id): JsonResponse
    {
        $teacher = $this->teacherRepository->findOneBy([
            'id' => $id,
        ]);

        if (null === $teacher) {
            return $this->json([
                'data' => null,
            ]);
        }

        $coursesData = [];
        foreach ($teacher->getCourses() as $course) {
            $coursesData[] = [
                'code' => $course->getCode(),
                'title' => $course->getTitle(),
                'description' => $course->getDescription(),
            ];
        }

        return $this->json([
            'data' => [
                'teacherId' => $teacher->getId(),
                'firstname' => $teacher->getFirstname(),
                'surname' => $teacher->getSurname(),
                'middlename' => $teacher->getMiddlename(),
                'birthdayDate' => $teacher->getBirthdayDate()->format('Y-m-d'),
                'gender' => $teacher->getGender()->value,
                'courses' => $coursesData,
            ],
        ]);
    }

    #[Route('/api/teachers', name: 'get_teachers_data', methods: ['GET'])]
    public function getTeachers(): JsonResponse
    {
        $teachers = $this->teacherRepository->findAll();

        if ([] === $teachers) {
            return $this->json([
                'data' => null,
            ]);
        }

        $teachersData = [];
        foreach ($teachers as $teacher) {
            $coursesData = [];
            foreach ($teacher->getCourses() as $course) {
                $coursesData[] = [
                    'code' => $course->getCode(),
                    'title' => $course->getTitle(),
                    'description' => $course->getDescription(),
                ];
            }

            $teachersData[] = [
                'teacherId' => $teacher->getId(),
                'firstname' => $teacher->getFirstname(),
                'surname' => $teacher->getSurname(),
                'middlename' => $teacher->getMiddlename(),
                'birthdayDate' => $teacher->getBirthdayDate()->format('Y-m-d'),
                'gender' => $teacher->getGender()->value,
                'courses' => $coursesData,
            ];
        }

        return $this->json([
            'data' => $teachersData,
        ]);
    }
}
