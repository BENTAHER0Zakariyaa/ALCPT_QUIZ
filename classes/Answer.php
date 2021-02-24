<?php

namespace ALCPT_QUIZ;

class Answer
{
    private $db;

    public function __construct()
    {
        $this->db = new Database("alcpt_quiz");
    }

    public function addAnswers(array $data,$testId,$candidatId)
    {
        $questions=$data;
        $listening = 0;
        $reading = 0;
        for ($i=1; $i <= count($questions); $i++) { 
            $split=explode(":",$questions[$i]);
            $c=$this->db->query("SELECT * FROM questions WHERE testId={$testId} AND questionId={$split[0]} AND correctAnswer='{$split[1]}'")->count()!=0;
            $type=$this->db->query("SELECT questionType FROM questions WHERE testId={$testId} AND questionId={$split[0]} ")->result()[0]->questionType;
            if($type=='listening'):
                if($c):
                    $listening++;
                endif;
            else:
                if($c):
                    $reading++;
                endif;
            endif;
        }
        $type=$this->db->query("INSERT INTO scores (testId, candidatId, listening, reading) 
                                VALUES ({$testId},{$candidatId},{$listening},{$reading})");
        header("Location:endOfThetest.php");
    }
}
?>