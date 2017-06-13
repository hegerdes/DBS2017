<?php

namespace OpiumBundle\Controller;

use OpiumBundle\Entity\Exam;
use OpiumBundle\Entity\ExamParticipation;
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
        $user = $this->getUser();
        $exams = $this->getDoctrine()->getRepository('OpiumBundle:Exam')->findBySemesterId($semester, $user);

        // TODO: Get all exams in the given semester with enroll status of the currently logged in user
        //$exams = [];
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
        $user = $this->getUser();
        $part = $this->getDoctrine()->getRepository('OpiumBundle:ExamParticipation')->findExPaByExamAndStudent($exam, $user);

        if ($part != null)
        {
            throw $this->createNotFoundException(
                'User is alrady participationg'
            );
        }

        $newExPart = new ExamParticipation();
        $newExPart->setExam($exam);
        $newExPart->setStudent($user);
        $newExPart->setStatus(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($newExPart);
        $em->flush();

        /**  $exampart = $exam->getExamParticipationForExam($exam);
        if (!$exampart)
        {
            throw $this->createNotFoundException(
                'User is alrady participationg'
            );
        }
        $user = $this->getUser();
        $newExPart = new ExamParticipation();
        $newExPart->setExam($exam);
        $newExPart->setStudent($user);

        if(!$exam->addExamParticipation($newExPart))
        {
            throw $this->createNotFoundException(
                'No Participation found for exam'
            );
        }
       */

        /**
         *      $user = $this->getUser();

        $examPart = new ExamParticipation();
        $examPart->setStudent($user);
        $examPart->setExam($exam);

        $em = $this->getDoctrine()->getManager();
        $em->persist($examPart);
        $em->flush();
         */


        // TODO: Enroll currently logged in student to the given exam
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
        $user = $this->getUser();
        $ExamPart = $this->getDoctrine()->getRepository('OpiumBundle:ExamParticipation')->findExPaByExamAndStudent($exam, $user);

        $ExamPart = $ExamPart[0];
        if ($ExamPart == null)
        {
            throw $this->createNotFoundException(
                'No Participation found'
            );
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($ExamPart);
        $em->flush();



        /**
       $exampart = $exam->getExamParticipationForExam($exam);
        if (!$exampart)
        {
            throw $this->createNotFoundException(
                'No Participation found for exam'
            );
        }
        $ep = $exam->removeExamParticipation($exampart);
        if(!$ep)
        {
            throw $this->createNotFoundException(
                'Remove Participation failed'
            );
        }
         * /*

        /**
         * $em = $this->getDoctrine()->getManager();
        $exampart = $em->getRepository('OpiumBundle:ExamParticipation')->find($exam);

        if (!$exampart) {
        throw $this->createNotFoundException(
        'No Participation found for exam'
        );
        }

        $em->remove($exampart);
        $em->flush();
         */


        // TODO: Sign off currently logged in student from the given exam
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
