<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class GetCourseController extends AbstractController
{
    public function __construct(
        private readonly CourseRepository $courseRepository,
    ) {
    }

    #[Route('/api/courses/{id}', name: 'get_course_data', methods: ['GET'])]
    public function getCourseData(string $code): JsonResponse
    {
        $course = $this->courseRepository->findOneBy([
            'code' => $code,
        ]);

        if (null === $course) {
            return $this->json([
                'data' => null,
            ]);
        }

        return $this->json([
            'data' => [
                'code' => $course->getCode(),
                'title' => $course->getTitle(),
                'description' => $course->getDescription(),
                'createdAt' => $course->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $course->getUpdatedAt()->format('Y-m-d H:i:s'),
            ],
        ]);
    }

    #[Route('/api/courses', name: 'get_courses_data', methods: ['GET'])]
    public function getCourses(): JsonResponse
    {
        $courses = $this->courseRepository->findAll();

        if ([] === $courses) {
            return $this->json([
                'data' => null,
            ]);
        }

        $coursesData = [];
        foreach ($courses as $course) {
            $coursesData[] = [
                'code' => $course->getCode(),
                'title' => $course->getTitle(),
                'description' => $course->getDescription(),
                'createdAt' => $course->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $course->getUpdatedAt()->format('Y-m-d H:i:s'),
            ];
        }

        return $this->json([
            'data' => $coursesData,
        ]);
    }
}
