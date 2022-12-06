<?php

namespace App\Controller;

use App\Entity\Weather;
use App\Form\WeatherType;
use App\Repository\WeatherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/weather')]
class WeatherController extends AbstractController
{
    #[Route('/', name: 'app_weather_index', methods: ['GET'])]
    public function index(WeatherRepository $weatherRepository): Response
    {
        return $this->render('weather/index.html.twig', [
            'weather' => $weatherRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_WEATHER_CREATE")
     */
    #[Route('/new', name: 'app_weather_new', methods: ['GET', 'POST'])]
    public function new(Request $request, WeatherRepository $weatherRepository): Response
    {
        $weather = new Weather();
        $form = $this->createForm(WeatherType::class, $weather, [
            'validation_groups' => ['new'],
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weatherRepository->save($weather, true);

            return $this->redirectToRoute('app_weather_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('weather/new.html.twig', [
            'weather' => $weather,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_weather_show', methods: ['GET'])]
    public function show(Weather $weather): Response
    {
        return $this->render('weather/show.html.twig', [
            'weather' => $weather,
        ]);
    }

    /**
     * @IsGranted("ROLE_WEATHER_EDIT")
     */
    #[Route('/{id}/edit', name: 'app_weather_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Weather $weather, WeatherRepository $weatherRepository): Response
    {
        $form = $this->createForm(WeatherType::class, $weather, [
            'validation_groups' => ['edit'],
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weatherRepository->save($weather, true);

            return $this->redirectToRoute('app_weather_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('weather/edit.html.twig', [
            'weather' => $weather,
            'form' => $form,
        ]);
    }

    /**
     * @IsGranted("ROLE_WEATHER_DELETE")
     */
    #[Route('/{id}', name: 'app_weather_delete', methods: ['POST'])]
    public function delete(Request $request, Weather $weather, WeatherRepository $weatherRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$weather->getId(), $request->request->get('_token'))) {
            $weatherRepository->remove($weather, true);
        }

        return $this->redirectToRoute('app_weather_index', [], Response::HTTP_SEE_OTHER);
    }
}

