<?php

namespace Controllers;

use Models\User;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class UserController
{
    private User $model;
    private Environment $twig;

    public function __construct()
    {
        $this->model = new User();
        $loader = new FilesystemLoader('views');
        $this->twig = new Environment($loader);
    }

    public function index(): void
    {
        $source = $_GET['source'] ?? 'local';
        $users = ($source === 'api') ? $this->getApiUsers() : $this->model->getAllUsers();

        echo $this->twig->render('users.html.twig', [
            "users" => $users,
            "source" => $source
        ]);
    }

    public function show(int $userId): void
    {
        $user = $this->model->getUserById($userId);
        $template = $this->twig->load('user.html.twig');
        echo $template->render(["user" => $user]);
    }

    public function store(): void
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

    public function edit(int $userId): void
    {
        $user = $this->model->getUserById($userId);
        $template = $this->twig->load('edit.html.twig');
        echo $template->render(["user" => $user]);
    }

    public function update(int $userId): void
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $status = $_POST['status'];

        if ($this->model->updateUserById($userId, $name, $email, $password, $gender, $status)) {
            echo "<p>User updated successfully!</p>";
            $this->show($userId);
        } else {
            echo 'Error updating user';
        }
    }

    public function delete(int $userId): void
    {
        $this->model->deleteUserById($userId);
        echo "User $userId was deleted successfully";
    }

    public function userForm(): void
    {
        include 'views/form.html';
    }

    public function paginateUsers(): void
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
        $offset = ($page - 1) * $limit;
        $source = $_GET['source'] ?? 'local';

        if ($source === 'api') {
            $allUsers = $this->getApiUsers();
        } else {
            $allUsers = $this->model->getAllUsers();
        }

        $total_users = count($allUsers);
        $total_pages = ceil($total_users / $limit);
        $paginate = array_slice($allUsers, $offset, $limit);

        echo $this->twig->render('list.html.twig', [
            "users" => $paginate,
            "total_pages" => $total_pages,
            "current_page" => $page,
            "limit" => $limit,
            "source" => $source
        ]);
    }

    private function getApiUsers(): array
    {
        $response = file_get_contents("https://gorest.co.in/public/v2/users");
        return json_decode($response, true) ?: [];
    }
}
