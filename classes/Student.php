<?php

namespace ALCPT_QUIZ;


class Student
{
    private $db;

    public function __construct()
    {
        $this->db=new Database("alcpt_quiz");
    }
    public function AddStudent(array $data)
    {
        $testId = $data["testId"];
        $lastName = $data["lastName"];
        $firstName = $data["firstName"];
        $matricule = $data["matricule"];
        $service = $data["service"];
        $rank = $data["rank"];
        $country = $data["country"];
        $instructorName = $data["instructorName"];
        if ($this->db->query("SELECT * FROM candidats WHERE candidatMatricule='{$matricule}' AND candidatTestId={$testId}")->count() == 0) {
            if ($this->db->query("INSERT INTO candidats (candidatTestId,candidatLastname,candidatfirstName,candidatMatricule,candidatService,candidatRank,candidatCountry,candidatInstructorName) 
            VALUES ({$testId},'{$lastName}','{$firstName}','{$matricule}','{$service}','{$rank}','{$country}','{$instructorName}')")) {
                
                Cookie::setCookie("studentId",$this->db->query("SELECT LAST_INSERT_ID() as 'id' ")->result()[0]->id,(60*60*3));
                Cookie::setCookie("testId",$testId,(60*60*3));

                return true;
            }
        }
        else{
            return false;
        }
    }
    public function deleteFromTest($testId)
    {
        $this->db->query("DELETE FROM candidats WHERE candidatTestId = {$testId}");
    }
}
?>