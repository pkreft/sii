<?php

namespace NewsBundle\Controller;

use NewsBundle\Factory\NewsFactory;
use NewsBundle\ResponseBuilder\NewsBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class NewsController
 * @package NewsBundle\Controller
 */
class NewsController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/", name="news")
     */
    public function indexAction(Request $request)
    {
        return $this->render('NewsBundle::index.html.twig');
    }

    /**
     * @param Request $request
     * @return form
     *
     * @Route("/add", name="news_add")
     */
    public function addAction(Request $request)
    {
        $news = NewsFactory::create();
        $formHandler = $this->get('sii.news.form.handler.add_news');

        if ( $formHandler->handle($news, $request) ) {
            $this->get('session')->getFlashBag()->add('success', 'News został dodany');

            return $this->redirect($this->generateUrl('news_add'));
        }

        return $this->render('NewsBundle::add.html.twig', array(
            'form'  => $formHandler->getForm()->createView()
        ));
    }

    /**
     * @param string $href
     * @return Response
     *
     * @Route("/news/{href}", name="news_details", options={"expose"=true})
     */
    public function detailsAction($href)
    {
        $news = $this->get('sii.news.repository.news')->findOneBy(array('href' => $href));

        if ( !$news ) {
            $this->get('session')->getFlashBag()->add('warning', 'Żądany zasób nie istnieje');

            return $this->redirect($this->generateUrl('news'));
        }

        return $this->render('NewsBundle::details.html.twig', array(
            'news'  => $news
        ));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * 
     * @Route("/fetch", name="news_fetch", options={"expose"=true})
     */
    public function fetchAction(Request $request)
    {
        $response = new JsonResponse();
        $dateTime = (new \DateTime())->format('Y-m-d H:i:s');
        $news = $this->get('sii.news.repository.news')->findNews($request->get('lastDateTime'));

        if ( $news ) {
            $changed = true;
            $result = NewsBuilder::build($news);
        } else {
            $changed = false;
            $result = array();
        }
        $response->setData(array_merge(array(
            'dateTime' => $dateTime,
            'changed' => $changed,
        ), $result));

        return $response;
    }
}
