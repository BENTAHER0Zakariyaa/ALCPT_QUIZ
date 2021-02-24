<?php

namespace ALCPT_QUIZ;


class Test
{
    private $db;

    public function __construct()
    {
        $this->db=new Database("alcpt_quiz");
    }

    public function Display()
    {
        $tests = $this->db->query("SELECT * FROM tests")->result();

        foreach ($tests as $key => $test) { ?>
            <tr>
                <td scope="row"><?= $test->testId ?></td>
                <td><?= $test->testName ?></td>
                <td><?= $test->testAudio ?></td>
                <td class="text-center">
                    <a href="deleteTest.php?id=<?= $test->testId ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        <?php }
    }
    public function DisplayOptions()
    {
        $tests = $this->db->query("SELECT testId FROM tests")->result();
        foreach ($tests as $key => $test) { ?>
            <option value="<?= $test->testId ?>" > <?= $test->testId ?></option>
        <?php }
    }
    public function DisplayOptionsName()
    {
        $tests = $this->db->query("SELECT * FROM tests")->result();
        foreach ($tests as $key => $test) { ?>
            <option value="<?= $test->testId ?>" > <?= $test->testName ?></option>
        <?php }
    }
    public function DisplayTests()
    {
        $tests = $this->db->query("SELECT * FROM tests")->result();
        foreach ($tests as $key => $test) { ?>
            <a href="questions.php?testId=<?= $test->testId ?>" class="list-group-item list-group-item-action"><?= $test->testName ?></a>
        <?php }
    }
    public function isExisted(int $id)
    {
        return $this->db->query("SELECT * FROM tests WHERE testId={$id}")->count()!=0;
    }
    public function AddTest(array $data, $fileName)
    {
        $testName = $data["testName"];
        $this->db->query("INSERT INTO tests (testName,testAudio) VALUES ('{$testName}','{$fileName}')");
    }
    public function DeleteTestById(int $id)
    {
        $this->db->query("DELETE FROM questions WHERE testId={$id}");
        $this->db->query("DELETE FROM scores WHERE testId={$id}"); 
        $this->db->query("DELETE FROM tests WHERE testId={$id}");
    }
    public function UpdateTestById(array $data, $fileName)
    {
        $testName = $data["testName"];
        $testId = $data["testId"];
        $this->db->query("UPDATE tests SET testName='{$testName}',testAudio='{$fileName}' WHERE testId={$testId}");
    }

    public function getTestAudio($id)
    {
        return $this->db->query("SELECT testAudio FROM tests WHERE testId={$id}")->result()[0]->testAudio;
    }
}
?>