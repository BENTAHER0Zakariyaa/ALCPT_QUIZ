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
        $firstName = $data["fistName"];
        $matricule = $data["matricule"];
        $rank = $data["rank"];
        $service = $data["service"];
        $country = $data["country"];
        $instructorName = $data["instructorName"];
        echo "<pre>";print_r($data);"</pre>";
        $this->db->query("INSERT INTO candidats (candidatTestId,candidatLastname,candidatFistname,candidatMatricule,candidatService,candidatRank,candidatCountry,candidatInstructorName) 
        VALUES ({$testId},'{$lastName}','{$firstName}','{$matricule}','{$service}','{$rank}','{$country}','{$instructorName}')");
        return $this->db->query("SELECT LAST_INSERT_ID() as 'id' ")->result()[0]->id;
    }
    public function UpdateInstructorById(array $data)
    {
        $instructorId = $data["instructorId"];
        $instructorName = $data["instructorName"];
        $instructorRank = $data["instructorRank"];
        $this->db->query("UPDATE instructors SET instructorName='{$instructorName}', instructorRank='{$instructorRank}' WHERE instructorId={$instructorId}");
    }
    public function DeleteInstructorById(int $id)
    {
        $this->db->query("DELETE FROM instructors WHERE instructorId={$id}");
    }
}
?>