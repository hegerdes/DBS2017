<?php
/**
 * Created by PhpStorm.
 * User: henne
 * Date: 07.05.17
 * Time: 21:36
 */

namespace OpiumBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BrowseController extends Controller
{
    /**
     * @Route("/browse")
     */

    public function showAction()
    {

        $directoryPath = $this->container->getParameter('kernel.root_dir') . '/../var/exams.csv';
        $content = file_get_contents($directoryPath);
        $rows = explode("\n", $content);


        $csvarray=array();
        foreach ($rows as $row) {
            $csvarray[] = str_getcsv($row);
        }
        array_shift($csvarray);



        $templating = $this->container->get('templating');
        $html = $templating->render('browse/show.html.twig',[
            'exams' => $csvarray
        ]);

        return new Response($html);

    }

}