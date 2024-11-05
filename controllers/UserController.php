<?php
namespace Controllers;

use Models\UserModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class UserController {
    private $model;
    private $twig;

    public function __construct() {
        $this->model = new UserModel();
        $loader = new FilesystemLoader('views');
        $this->twig = new Environment($loader);
    }

    public function index() {
        include 'views/main.html';
    }

    public function listUsers() {
        $users = $this->model->getAllUsers();
        $template = $this->twig->load('users.html.twig');
        echo $template->render(["users" => $users]);
    }

    public function addUserForm() {
        include 'views/form.html';
    }

    public function addUser()
    {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $gender = $_POST['gender'];
            $status = $_POST['status'];

            if ($this->model->setUser($name, $email, $password, $gender, $status)) {
                $userData = $this->model->getUser($email);

                if ($userData) {
                    echo "<p>User added successfully!</p>";
                    foreach ($userData as $key => $value) {
                        echo "<p>$key: $value</p>";
                    }
                } else {
                    echo 'Error retrieving user data.';
                }
            } else {
                echo 'Error adding user';
            }
    }

    public function paginateUsers() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
        $offset = ($page - 1) * $limit;

        $paginate = $this->model->paginate($limit, $offset);
        $total_users = $this->model->getAllUsers();
        $total_pages = ceil(count($total_users) / $limit);

        $template = $this->twig->load('list.html.twig');
        echo $template->render([
            "users" => $paginate,
            "total_pages" => $total_pages,
            "current_page" => $page,
            "limit" => $limit
        ]);
    }

    public function viewUser($userId) {
        $user = $this->model->getUserById($userId);
        $template = $this->twig->load('user.html.twig');
        echo $template->render(["user" => $user]);
    }

    public function deleteUser($userId) {
        $this->model->deleteUserById($userId);
        echo "User $userId was deleted successful";
    }
}
