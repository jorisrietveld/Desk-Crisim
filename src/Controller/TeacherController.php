<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;

    class TeacherController extends AbstractController
    {
        /**
         * @return \Symfony\Component\HttpFoundation\Response
         */
        public function index()
        {
            return $this->render('teacher/Index.html.twig');
        }

        public function loadEvent()
        {
            return $this->render('teacher/scenario/CreateEvent.html.twig');
        }

        public function participators()
        {
            return $this->render('teacher/Participators.html.twig', array(
                'students' => [
                    '325' => [
                        'email' => 'student@stenden.com',
                        'name' => 'S. Student',
                        'actor' => 'Politie',
                        'online' => 'green-text',
                        'number' => '12345'
                    ],
                    '634' => [
                        'email' => 'student@stenden.com',
                        'name' => 'S. Student',
                        'actor' => 'Ambulance',
                        'online' => 'red-text',
                        'number' => '12345'
                    ],
                    '457' => [
                        'email' => 'student@stenden.com',
                        'name' => 'S. Student',
                        'actor' => 'Ambulance',
                        'online' => 'red-text',
                        'number' => '12345'
                    ]]
            ));
        }

        public function showStatistics()
        {
            return $this->render('teacher/Statistics.html.twig');
        }

        public function startScenario()
        {
            return $this->render('teacher/scenario/Start.html.twig');
        }

        public function uploadScenario()
        {
            return $this->render('teacher/scenario/Upload.html.twig');
        }

        public function chatMonitor()
        {
            return $this->render('teacher/chat/ChatMonitor.html.twig', array(
                "messages" => [

                    "msg1" => [
                        'text' => 'Hey Actor!',
                        'time' => '13:21',
                        'actor' => 'Ambulance'
                    ],
                    "msg2" => [
                        'text' => 'Hey Arnold!',
                        'time' => '15:21',
                        'actor' => 'Ambulance'
                    ],
                    "msg3" => [
                        'text' => 'Hey Test!',
                        'time' => '17:33',
                        'actor' => 'Ambulance'
                    ]


                ]
            ));
        }

        public function createSession(Request $request)
        {
            return $this->render('teacher/CreateSession.html.twig', [
                "Something" => $request
            ]);

        }

        public function assignPoints()
        {
            return $this->render('teacher/AssignPoints.html.twig');
        }
    }
