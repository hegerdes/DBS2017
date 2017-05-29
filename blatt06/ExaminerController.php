<?php

namespace OpiumBundle\Controller;

use OpiumBundle\Entity\Exam;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExaminerController extends Controller
{
    /**
     * @Route("/examiner/", name="examiner")
     * @Method("GET")
     * @Template
     */
    public function indexAction()
    {
        $examinerId = $this->getUser()->getId();

        $repo = $this->getDoctrine()->getRepository('OpiumBundle:Exam');
        $exams = $repo->getAllExamsforExaminer($examinerId);

        // TODO: Load all exams, where examiner id == $examinerId
        // $exams = [];
        return ['exams' => $exams];
    }

    /**
     * @Route("/examiner/exam/{exam}/details/", name="examiner_details", requirements={"exam": "\d+"})
     * @Method("GET")
     * @Template
     *
     * @param Exam $exam
     * @return array
     */
    public function detailAction(Exam $exam)
    {
        $examID = $exam->getID();

        $repo = $this->getDoctrine()->getRepository('OpiumBundle:Student');
        $students = $repo->getAllStudensForExamID($examID);
        // TODO: Load all students which participate in the given exam
        // $students = [];
        return ['students' => $students, 'exam' => $exam, 'test' => $examID];
    }
}
