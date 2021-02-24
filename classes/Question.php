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

        $testId=$data['testId'];
        $questionNumber=$data['questionNumber'];
        $question=str_replace("'","\'",$data['question']);
        $correct=str_replace("'","\'",$data['isCorrect']);
        $answerA=str_replace("'","\'",$data['answerA']);
        $answerB=str_replace("'","\'",$data['answerB']);
        $answerC=str_replace("'","\'",$data['answerC']);
        $answerD=str_replace("'","\'",$data['answerD']);
        $questionType=@$data['questionType'];

        if(!$this->isExisted($questionNumber)):
            $this->db->query("INSERT INTO questions (testId, questionNumber, question,questionType, answerA, answerB, answerC, answerD, correctAnswer) 
                        VALUES({$testId}, {$questionNumber},'{$question}','{$questionType}','{$answerA}','{$answerB}','{$answerC}','{$answerD}','{$correct}')");
            return true;
        else :
            return false;
        endif;
    }

    public function isExisted(int $id)
    {
        return $this->db->query("SELECT * FROM questions WHERE questionId={$id}")->count() != 0;
    }
    public function deleteQuestionById(int $id)
    {
        if($this->isExisted($id)):
            $this->db->query("DELETE FROM questions WHERE questionId={$id}");
            return true;
        else :
            return false;
        endif;
    }
    public function updateQuestion(array $data)
    {
        $testId=$data['testId'];
        $questionNumber=$data['questionNumber'];

        $question=str_replace("'","\'",$data['question']);
        $correct=str_replace("'","\'",$data['isCorrect']);
        $answerA=str_replace("'","\'",$data['answerA']);
        $answerB=str_replace("'","\'",$data['answerB']);
        $answerC=str_replace("'","\'",$data['answerC']);
        $answerD=str_replace("'","\'",$data['answerD']);
        $questionType=@$data['questionType'];

        if($this->db->query("SELECT * FROM questions WHERE questionNumber={$questionNumber}")->count() != 0):
            $this->db->query("UPDATE questions 
            SET question = '{$question}', questionType = '{$questionType}' ,correctAnswer = '{$correct}', answerA = '{$answerA}', answerB = '{$answerB}', answerC = '{$answerC}', answerD = '{$answerD}'
            WHERE questionNumber = {$questionNumber} and testId = {$testId}");
            return true;
        else :
            return false;
        endif;
    }
    public function DisplayInTable($testId)
    {
        $questions = $this->db->query("SELECT * FROM questions WHERE testId = {$testId}")->result();
        foreach ($questions as $key => $question) { ?>
            <tr>
                <td scope="row"><?= $question->questionNumber ?></td>
                <td><?= $question->question ?></td>
                <td><?= $question->correctAnswer ?></td>
                <td class="text-center">
                    <a href="deleteQuestion.php?questionId=<?= $question->questionId ?>&testId=<?= $question->testId ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        <?php }
    }

    public function getAllQuestionsByTestIdAndType($testId,$questionType)
    {
        return $this->db->query("SELECT * FROM questions WHERE testId = {$testId} AND questionType='{$questionType}'")->result();
    }

    public function getCount($testId)
    {
        return $this->db->query("SELECT * FROM questions WHERE testId = {$testId}")->Count();
    }

}
?>