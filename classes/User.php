<?php

namespace ALCPT_QUIZ;

include __DIR__."/Session.php";

class User
{
    private $db;

    public function __construct()
    {
        $this->db=new Database("alcpt_quiz");
    }

    public function Display()
    {
        $users = $this->db->query("SELECT * FROM users")->result();

        foreach ($users as $key => $user) { ?>
            <tr>
                <td scope="row"><?= $user->userId?></td>
                <td><?= $user->userName?></td>
                <td class="text-center">
                    <a href="deleteUser.php?id=<?= $user->userId?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        <?php }
    }
    public function isExisted(int $id)
    {
        return $this->db->query("SELECT * FROM users WHERE userId={$id}")->count()!=0;
    }
    public function AddUser(array $data)
    {
        $userName = $data["userName"];
        $userPassword = password_hash($data["userPassword"],PASSWORD_DEFAULT);
        $this->db->query("INSERT INTO users (userName,userPassword) VALUES ('{$userName}','{$userPassword}')");
    }
    public function DeleteUserById(int $id)
    {
        $this->db->query("DELETE FROM users WHERE userId={$id}");
    }


    public function userLogin(array $data)
    {
        $userName = $data["userName"];
        $userPassword = $data["userPassword"];
        $user=$this->db->query("SELECT * FROM users WHERE username='{$userName}'");
        if($user->count() != 0):
            $user = $user->result()[0];
            if(password_verify($userPassword, $user->userPassword)):
                Session::init();
                Session::setValue("login", true);
                Session::setValue("userId", $user->userId);
                Session::setValue("userName", $user->userName);
                header("Location:index.php");
            else:
                return 2;
            endif;
        else:
            return 1;
        endif;
    }
}
?>