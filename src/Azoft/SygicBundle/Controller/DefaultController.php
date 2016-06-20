<?php

namespace Azoft\SygicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Azoft\SygicBundle\Service\Sygic;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AzoftSygicBundle:Default:index.html.twig');
    }

    public function jobsListAction()
    {
        /** @var Sygic $sygicAPI */
        $sygicAPI = $this->get('azoft.sygic');

        $content = $sygicAPI->listJobs();

        return $this->render('AzoftSygicBundle:Jobs:list.html.twig', array(
           'jobs' => $content
        ));
    }

    public function createJobTemplateAction()
    {
        /** @var Sygic $sygicAPI */
        $sygicAPI = $this->get('azoft.sygic');

        $content = $sygicAPI->createJob();

        dump($content);die();

    }
}
