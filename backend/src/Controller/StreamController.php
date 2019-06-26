<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Stream;
use App\Form\StreamType;
use App\Service\StreamManager;
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
 * @Route("/api/v1/streams")
 */
class StreamController extends FOSRestController
{
    /**
     * @var StreamManager
     */
    private $streamManager;

    /**
     * StreamController constructor.
     *
     * @param StreamManager $streamManager
     */
    public function __construct(StreamManager $streamManager)
    {
        $this->streamManager = $streamManager;
    }

    /**
     * @Route("/", methods={"GET"})
     * @RestView()
     *
     * @return array
     */
    public function getAll(): array
    {
        $streams = $this->streamManager->getStreams();

        return ['streams' => $streams];
    }

    /**
     * @Route("/{id}", methods={"GET"})
     * @ParamConverter(name="stream", class="App\Entity\Stream")
     * @RestView()
     *
     * @param Stream $stream
     *
     * @return array
     */
    public function getOne(Stream $stream): array
    {
        return ['stream' => $stream];
    }

    /**
     * @Route("/", methods={"POST"})
     * @RestView()
     *
     * @param Request $request
     *
     * @return FormInterface|View
     */
    public function create(Request $request)
    {
        return $this->processRequestForm($request, new Stream());
    }

    /**
     * @Route("/{id}", methods={"PUT"})
     * @ParamConverter(name="stream", class="App\Entity\Stream")
     * @RestView()
     *
     * @param Request $request
     * @param Stream  $stream
     *
     * @return FormInterface|View
     */
    public function update(Request $request, Stream $stream)
    {
        return $this->processRequestForm($request, $stream);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     * @ParamConverter(name="stream", class="App\Entity\Stream")
     * @RestView(statusCode=204)
     *
     * @param Stream $stream
     */
    public function delete(Stream $stream): void
    {
        $this->streamManager->removeStream($stream);
    }

    /**
     * @param Request $request
     * @param Stream  $stream
     *
     * @return View
     */
    private function processRequestForm(Request $request, Stream $stream): View
    {
        $form = $this->createForm(
            StreamType::class,
            $stream,
            [
                'method' => $request->getMethod(),
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->streamManager->updateStream($stream);

                return $this->routeRedirectView(
                    'app_stream_getone',
                    [
                        'id' => $stream->getId(),
                    ],
                    $request->isMethod('POST') ? Response::HTTP_CREATED : Response::HTTP_NO_CONTENT
                );
            }

            return $this->view($form, Response::HTTP_BAD_REQUEST);
        }

        throw new BadRequestHttpException();
    }
}
