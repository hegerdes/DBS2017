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
        $connection = pg_connect("host=dbs17.informatik.uos.de dbname=hegerdes user=hegerdes password=969272 port=5432");
        $answer = pg_query_params($connection, "select * from exam;", []);
        $result = pg_fetch_all($answer);
        pg_close($connection);

        $sp_names = (array_keys($result[0]));
        $laenge_a = (count($sp_names) - 1);
        $laenge_t = (count($result) -1);



        $templating = $this->container->get('templating');
        $html = $templating->render('browse/show.html.twig',[
            'exams' => $result,
            'names' => $sp_names,
            'atributlaenge'=> $laenge_a,
            'tupellaenge'=> $laenge_t
        ]);

        return new Response($html);

    }

}