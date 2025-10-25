<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GetStudentController extends AbstractController
{
    public function __construct(
        private readonly StudentRepository $studentRepository,
    ) {
    }

    #[Route('/api/students/{id}', name: 'get_student_data', methods: ['GET'])]
    public function getStudentData(int $id): JsonResponse
    {
        $student = $this->studentRepository->findOneBy([
            'id' => $id,
        ]);

        if (null === $student) {
            return $this->json([
                'data' => null,
            ]);
        }

        return $this->json([
            'data' => [
                'studentId' => $student->getId(),
                'firstname' => $student->getFirstname(),
                'surname' => $student->getSurname(),
                'middlename' => $student->getMiddlename(),
                'birthdayDate' => $student->getBirthdayDate()->format('Y/m/d'),
                'gender' => $student->getGender()->value,
                'createdAt' => $student->getCreatedAt()->format('Y/m/d H:i:s'),
                'updatedAt' => $student->getUpdatedAt()->format('Y/m/d H:i:s'),
            ],
        ]);
    }

    #[Route('/students', name: 'get_students_data', methods: ['GET'])]
    public function getStudents(): Response
    {
        $students = $this->studentRepository->findAll();

        $studentsData = [];
        foreach ($students as $student) {
            $studentsData[] = [
                'studentId' => $student->getId(),
                'firstname' => $student->getFirstname(),
                'surname' => $student->getSurname(),
                'middlename' => $student->getMiddlename(),
                'birthdayDate' => $student->getBirthdayDate()->format('d.m.Y'),
                'gender' => $student->getGender()->value,
                'createdAt' => $student->getCreatedAt()->format('d.m.Y H:i:s'),
                'updatedAt' => $student->getUpdatedAt()->format('d.m.Y H:i:s'),
            ];
        }

        return $this->render('students/index.html.twig', [
            'students' => $studentsData,
        ]);
    }
}
