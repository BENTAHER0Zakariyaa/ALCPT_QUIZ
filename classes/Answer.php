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
        foreach ($questions as $key => $value) {

            $split=explode(":",$questions[$key]);
            echo $split[0]."<br>";
            $c = $this->db->query("SELECT * FROM questions WHERE testId={$testId} AND questionId={$split[0]} AND correctAnswer='{$split[1]}'")->count()!=0;
            $type=$this->db->query("SELECT questionType FROM questions WHERE testId={$testId} AND questionId={$split[0]} ")->result()[0]->questionType;
            if($type=='listening'):
                if($c):
                    $listening++;
                endif;
            elseif($type=='reading'):
                if($c):
                    $reading++;
                endif;
            endif;
        }
        $this->db->query("UPDATE candidats SET candidatListening={$listening}, candidatReading={$reading} WHERE candidatId={$candidatId}");
        if (isset($_COOKIE['testId']) && isset($_COOKIE['studentId'])) {

            unset($_COOKIE['testId']); 
            setcookie('testId', "", time()-(60*60*3),); 
            unset($_COOKIE['studentId']); 
            setcookie('studentId', "", time()-(60*60*3),);  
            
          }
        header("Location:endOfThetest.php");
    }
}
?>