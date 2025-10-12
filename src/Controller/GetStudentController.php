<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $student = $this->studentRepository->findOneBy(['id' => $id]);

        if (! $student) {
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
                'createdAt' => $student->getCreatedAt()->format('Y/m/d H:i:s'),
                'updatedAt' => $student->getUpdatedAt()->format('Y/m/d H:i:s')
            ]
        ]);
    }
}
