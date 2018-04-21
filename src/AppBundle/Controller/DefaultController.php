<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Services\BlackMirorService;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @param BlackMirorService $blackMirorService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, BlackMirorService $blackMirorService)
    {
        $url   = $this->getParameter('ressource_api');
        $token = $this->getParameter('ressource_token');
        $results = $blackMirorService->getOrPostFromAPI('GET', $url, false, $token);
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'blackmiror' => json_decode($results, true),

        ]);
    }

    /**
     * @Route("/episode/{id}", name="episode_view", requirements={"id"="\d+"})
     * @param Request $request
     * @param BlackMirorService $blackMirorService
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function espisodeAction(Request $request, BlackMirorService $blackMirorService, $id)
    {
        $url   = $this->getParameter('blackmiror_api')."episodes/".$id;
        $episode = $blackMirorService->getOrPostFromAPI('GET', $url);
        dump($episode);

        return $this->render('default/episode.html.twig', [
            'episode' => json_decode($episode, true),
        ]);
    }
}
