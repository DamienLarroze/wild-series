<?php

// src/Controller/ProgramController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProgramRepository;

#[Route('/program/', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();
        return $this->render('program/index.html.twig', ['programs' => $programs]);
    }

    #[Route('{id<\d+>}', methods: ['GET'], name: 'show')]
    public function show(ProgramRepository $programRepository, int $id): Response
    {
        $programs = $programRepository->findOneBy(['id' => $id]);
        return $this->render('program/show.html.twig', ['program' => $programs]);
    }
}
