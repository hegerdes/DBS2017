<?php

namespace OpiumBundle\Controller;

use OpiumBundle\Entity\Exam;
use OpiumBundle\Entity\Semester;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BrowseController extends Controller
{
    /**
     * @Route("/browse/{semester}/", name="browse", requirements={"semester": "\d+"})
     * @Method("GET")
     * @Template
     *
     * @param Semester $semester
     * @return array
     */
    public function indexAction(Semester $semester)
    {
        $exams = [];
        return ['exams' => $exams];
    }

    /**
     * @Route("/browse/", name="browse_semester")
     * @Method("GET")
     * @Template
     */
    public function semesterAction()
    {
        $semesters = $this->getDoctrine()->getRepository('OpiumBundle:Semester')->findAll();
        return ['semesters' => $semesters];
    }

    /**
     * @Route("/browse/enroll/{exam}/", name="enroll", requirements={"exam": "\d+"})
     * @Method("POST")
     *
     * @param Exam $exam
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function enrollAction(Exam $exam)
    {
        return $this->redirectToRoute('browse', ['semester' => $exam->getSemester()->getId()]);
    }

    /**
     * @Route("/browse/sign-off/{exam}/", name="sign_off", requirements={"exam": "\d+"})
     * @Method("POST")
     *
     * @param Exam $exam
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function signOffAction(Exam $exam)
    {
        return $this->redirectToRoute('browse', ['semester' => $exam->getSemester()->getId()]);
    }

    /**
     * @Route("/browse/enrolled/", name="browse_enrolled")
     * @Method("GET")
     * @Template
     */
    public function enrolledAction()
    {
        $exams = [];
        return ['exams' => $exams];
    }

    /**
     * @Route("/browse/results/", name="browse_results")
     * @Method("GET")
     * @Template
     */
    public function resultsAction()
    {
        $exams = [];
        return ['exams' => $exams];
    }
}
