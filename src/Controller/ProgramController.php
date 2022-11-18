<?php

// src/Controller/ProgramController.php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Repository\EpisodeRepository;

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
    public function show(ProgramRepository $programRepository, SeasonRepository $seasonRepository, int $id): Response
    {
        $programs = $programRepository->findOneBy(['id' => $id]);
        $season = $seasonRepository->findBy(['program' => $programs], ['id' => 'DESC']);
        return $this->render('program/show.html.twig', ['program' => $programs, 'season' => $season]);
    }

    #[Route('{program<\d+>}/season/{season<\d+>}', methods: ['GET'], name: 'season_show')]
    public function episode(EpisodeRepository $episodeRepository, Season $season, Program $program): Response
    {
        $episode = $episodeRepository->findBy(['season' => $season], ['id' => 'ASC']);
        return $this->render('program/season_show.html.twig', ['season' => $episode, 'program' => $program]);
    }
}
