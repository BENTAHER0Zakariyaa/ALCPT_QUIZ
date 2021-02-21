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
        $Nquestion=str_replace("'","\'",$data['Nquestion']);
        $question=str_replace("'","\'",$data['question']);
        $correct=str_replace("'","\'",$data['isCorrect']);
        $answerA=str_replace("'","\'",$data['answerA']);
        $answerB=str_replace("'","\'",$data['answerB']);
        $answerC=str_replace("'","\'",$data['answerC']);
        $answerD=str_replace("'","\'",$data['answerD']);
        if(!$this->isExisted($Nquestion)):
            
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
            return true;
        else :
            return false;
        endif;

    }

    public function getAllQuestionForAdmin()
    {
        $questions = $this->db->query("SELECT * FROM questions ORDER BY questionId ASC")->result();

    foreach ($questions as $key => $question) { ?>
        <div class="card mb-2">
            <div class="card-body">
            <h6 class="card-subtitle mb-2 text-muted"><span class="badge bg-primary"> <?= $question->questionId ?></span></h6>
            <h5 class="card-title">
                <?php
                    $qu=str_replace("\n","<br>",$question->question);
                    $qu=str_replace("\_","__________",$qu);
                    echo  $qu;
                ?>
            </h5>
            <br>
        <?php  
        $alpha = ["A", "B", "C", "D"];
        $answers = $this->db->query("SELECT * FROM answers WHERE questionId=".$question->questionId."")->result();
        foreach ($answers as $key => $answer){ ?>
                <p class="card-text"><?php echo @"<b>{$alpha[$key]}</b> - {$answer->answer}"; ?></p>
        <?php } ?>
            </div>
        </div>
    <?php } 
    }
    public function getQuestionById(int $id)
    {
        $question=[
            "question" => $this->db->query("SELECT * FROM questions WHERE questionId={$id}")->result()[0],
            "answers" => $this->db->query("SELECT * FROM answers WHERE answers.questionId={$id}")->result()
        ];
        return $question;
    }
    public function isExisted(int $id)
    {
        return $this->db->query("SELECT * FROM questions WHERE questionId={$id}")->count() != 0;
    }
    public function deleteQuestionById(int $id)
    {
        
        if($this->isExisted($id)):
            $this->db->query("DELETE FROM answers WHERE answers.questionId={$id}");
            $this->db->query("DELETE FROM questions WHERE questionId={$id}");
            return true;
        else :
            return false;
        endif;
    }


}
