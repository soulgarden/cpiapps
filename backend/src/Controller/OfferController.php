<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Form\OfferType;
use App\Service\OfferManager;
use FOS\RestBundle\Controller\Annotations\View as RestView;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1/offers")
 */
class OfferController extends FOSRestController
{
    /**
     * @var OfferManager
     */
    private $offerService;

    /**
     * OfferController constructor.
     * @param OfferManager $offerService
     */
    public function __construct(OfferManager $offerService)
    {
        $this->offerService = $offerService;
    }

    /**
     * @Route("/", methods={"GET"})
     * @RestView()
     * @return array
     */
    public function getAll(): array
    {
        $offers = $this->offerService->getOffers();

        return ['offers' => $offers];
    }

    /**
     * @Route("/{id}", methods={"GET"})
     * @ParamConverter(name="offer", class="App\Entity\Offer")
     * @RestView()
     * @param Offer $offer
     * @return array
     */
    public function getOne(Offer $offer): array
    {
        return ['offer' => $offer];
    }

    /**
     * @Route("/", methods={"POST"})
     * @RestView()
     * @param Request $request
     * @return View|FormInterface
     */
    public function create(Request $request)
    {
        return $this->processRequestForm($request, new Offer());
    }

    /**
     * @Route("/{id}", methods={"PUT"})
     * @ParamConverter(name="offer", class="App\Entity\Offer")
     * @RestView()
     * @param Request $request
     * @param Offer   $offer
     * @return View|FormInterface
     */
    public function update(Request $request, Offer $offer)
    {
        return $this->processRequestForm($request, $offer);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     * @ParamConverter(name="offer", class="App\Entity\Offer")
     * @RestView(statusCode=204)
     * @param Offer $offer
     */
    public function delete(Offer $offer): void
    {
        $this->offerService->removeOffer($offer);
    }

    /**
     * @param Request $request
     * @param Offer   $offer
     * @return View|FormInterface
     */
    private function processRequestForm(Request $request, Offer $offer)
    {
        $form = $this->createForm(OfferType::class, $offer, [
            'method' => $request->getMethod(),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->offerService->updateOffer($offer);

                return $this->routeRedirectView(
                    'app_offer_getone',
                    [
                        'id' => $offer->getId(),
                    ],
                    $request->isMethod('POST') ? Response::HTTP_CREATED : Response::HTTP_NO_CONTENT
                );
            }

            return $form;
        }

        throw new BadRequestHttpException();
    }
}
