<?php

namespace ALCPT_QUIZ;

class Instructor
{
    private $db;

    public function __construct()
    {
        $this->db=new Database("alcpt_quiz");
    }

    public function Display()
    {
        $instructors = $this->db->query("SELECT * FROM instructors")->result();

        foreach ($instructors as $key => $instructor) { ?>
            <tr>
                <td scope="row"><?= $instructor->instructorId ?></td>
                <td scope="row"><?= $instructor->instructorName ?></td>
                <td><?= $instructor->instructorRank ?></td>
                <td class="text-center">
                    <a href="deleteInstructor.php?instructorId=<?= $instructor->instructorId ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        <?php }
    }
    public function DisplayOptions()
    {
        $instructors = $this->db->query("SELECT * FROM instructors")->result();
        foreach ($instructors as $key => $instructor) { ?>
            <option value="<?= $instructor->instructorId ?>" > <?= $instructor->instructorId ?></option>
        <?php }
    }
    public function DisplayOptionsName()
    {
        $instructors = $this->db->query("SELECT * FROM instructors")->result();
        foreach ($instructors as $key => $instructor) { ?>
            <option value="<?= $instructor->instructorName ?>" > <?= $instructor->instructorName ?></option>
        <?php }
    }
    public function isExisted(int $id)
    {
        return $this->db->query("SELECT * FROM instructors WHERE instructorId={$id}")->count()!=0;
    }
    public function AddInstructor(array $data)
    {
        $instructorName = $data["instructorName"];
        $instructorRank = $data["instructorRank"];
        $this->db->query("INSERT INTO instructors (instructorName,instructorRank) VALUES ('{$instructorName}','{$instructorRank}')");
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