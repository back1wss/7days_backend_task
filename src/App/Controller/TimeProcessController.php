<?php

declare(strict_types=1);


namespace App\Controller;

use App\DTO\TimeProcessDTO;
use App\DTO\TimeRequestDTO;
use App\Form\TimeProcessForm;
use App\Service\TimeProcessor;
use DateTime;
use DateTimeZone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @Route("/time", name="time_")
 */
class TimeProcessController extends AbstractController
{
    private DenormalizerInterface $denormalizer;

    public function __construct(DenormalizerInterface $denormalizer)
    {
        $this->denormalizer = $denormalizer;
    }

    /**
     * @Route("", name="process", methods={"POST","GET"})
     */
    public function process(Request $request, TimeProcessor $timeProcessor): Response
    {
        $form = $this->createForm(TimeProcessForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timeRequestDTO = $this->denormalizer->denormalize($form->getData(), TimeRequestDTO::class);
            $timeProcessDTO = $timeProcessor->process($timeRequestDTO);

            return $this->render('time/processed.html.twig', [
                'formData' => $timeProcessDTO
            ]);
        }

        return $this->render('time/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}