<?php

namespace AppBundle\Controller;

use AppBundle\Event\EchoEvent;
use AppBundle\Event\EchoEvents;
use AppBundle\Form\Type\EchoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new EchoType());

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/echo", name="index_echo")
     */
    public function sendAction(Request $request)
    {
        $form = $this->createForm(new EchoType());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $eventDispatcher = $this->get('event_dispatcher');
            $eventDispatcher->dispatch(EchoEvents::ECHO_EVENT, new EchoEvent($data));

            return new JsonResponse([
                'status' => true,
            ]);
        }

        return new JsonResponse([
            'status' => false,
        ]);
    }
}
