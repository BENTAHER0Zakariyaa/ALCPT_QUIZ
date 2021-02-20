<?php

namespace ALCPT_QUIZ;

class Question
{
    private $db;

    public function __construct()
    {
        $this->db = new Database("alcpt_quiz");
    }

    public function addQuestion(array $data)
    {
        $Nquestion=$data['Nquestion'];
        $question=$data['question'];
        $correct=$data['isCorrect'];
        $answerA=$data['answerA'];
        $answerB=$data['answerB'];
        $answerC=$data['answerC'];
        $answerD=$data['answerD'];

        $this->db->query("INSERT INTO questions (questionId,question) VALUES({$Nquestion},'{$question}')");

        switch ($correct) {

            case 'a':
                $this->db->query("INSERT INTO answers (questionId, answer, isCorrect)
                                 VALUES ({$Nquestion},'{$answerA}',1),
                                        ({$Nquestion},'{$answerB}',0),
                                        ({$Nquestion},'{$answerC}',0),
                                        ({$Nquestion},'{$answerD}',0) ");
                break;

            case 'b':
                $this->db->query("INSERT INTO answers (questionId, answer, isCorrect)
                                 VALUES ({$Nquestion},'{$answerA}',0),
                                        ({$Nquestion},'{$answerB}',1),
                                        ({$Nquestion},'{$answerC}',0),
                                        ({$Nquestion},'{$answerD}',0) ");
                break;

            case 'c':
                $this->db->query("INSERT INTO answers (questionId, answer, isCorrect)
                                 VALUES ({$Nquestion},'{$answerA}',0),
                                        ({$Nquestion},'{$answerB}',0),
                                        ({$Nquestion},'{$answerC}',1),
                                        ({$Nquestion},'{$answerD}',0) ");
                break;

            case 'd':
                $this->db->query("INSERT INTO answers (questionId, answer, isCorrect)
                                 VALUES ({$Nquestion},'{$answerA}',0),
                                        ({$Nquestion},'{$answerB}',0),
                                        ({$Nquestion},'{$answerC}',0),
                                        ({$Nquestion},'{$answerD}',1) ");
                break;
        }
        return ["successfully"=>"Done!"];
    }

}
