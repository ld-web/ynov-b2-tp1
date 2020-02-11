<?php

namespace App\Controller;

use App\Repository\CardTemplateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TemplateController extends AbstractController
{
  /**
   * @Route("/templates", name="templates_list")
   */
  public function list(CardTemplateRepository $cardTemplateRepository)
  {
    $cardTemplates = $cardTemplateRepository->findAll();

    return $this->render('template/list.html.twig', [
      'templates' => $cardTemplates
    ]);
  }
}
