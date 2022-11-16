<?php

// src/Controller/ProgramController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;

#[Route('/category/', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $cat = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', ['cat' => $cat]);
    }

    #[Route('{name}', methods: ['GET'], name: 'show')]
    public function show(ProgramRepository $programRepository, CategoryRepository $categoryRepository, string $name): Response
    {
        $cat = $categoryRepository->findOneBy(['name' => $name]);
        $programs = $programRepository->findBy(['category' => $cat], ['id' => 'DESC'], 3, 0);
        return $this->render('category/show.html.twig', ['category' => $programs]);
    }
}
