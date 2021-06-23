<?php

namespace App\Controller;

use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{

    /**
     * @Route(
     *     "/{_locate}/lucky/number",
     *     methods={"GET"},
     *     name="_number"
     * )
     * @throws Exception
     */
    public function number(Request $request): Response
    {
        $number = random_int(0, 100);

        $routeName = $request->attributes->all();
//        $url = $this->generateUrl('/blog/en/lucky/number', ['max' => 10]);
        return $this->render('lucky/number.html.twig', [
           'number' => $number
        ]);

//        return $this->redirectToRoute('user__all');
    }

    /**
     * @return JsonResponse
     * @Route("/json", name="_json")
     */
    public function jsonRes(): JsonResponse
    {
        $num = 10;

        return $this->json($num, Response::HTTP_OK);
    }
}