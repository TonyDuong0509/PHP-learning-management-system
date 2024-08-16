<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function save($data)
    {
        global $conn;
        $name = $data['name'];
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $created_at = $data['created_at'];
        $role = $data['role'];
        $status = $data['status'];

        $sql = "INSERT INTO users (name, username, email, password, created_at ,role, status)
                VALUES ('$name', '$username', '$email', '$password', '$created_at', '$role', '$status')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            return $last_id;
        }
        echo "Error " . $sql . PHP_EOL;
        return false;
    }

    public function fetchAll($condition = null)
    {
        global $conn;
        $users = array();
        $sql = "SELECT * FROM users";

        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user = new User(
                    $row['id'],
                    $row['name'],
                    $row['username'],
                    $row['email'],
                    $row['password'],
                    $row['photo'],
                    $row['created_at'],
                    $row['role'],
                    $row['status']
                );
            }
            $users[] = $user;
        }

        return $users;
    }

    public function getUserByEmail($email)
    {
        $condition = "email = '$email'";
        $users = $this->fetchAll($condition);
        $user = current($users);

        return $user;
    }

    public function getById($id)
    {
        $condition = "id = '$id'";
        $users = $this->fetchAll($condition);
        $user = current($users);

        return $user;
    }

    public function getInstructorsByRole()
    {
        global $conn;

        $condition = "role = 'instructor'";
        $instructors = $this->fetchAll($condition);

        return $instructors;
    }

    public function update($user)
    {
        global $conn;
        $id = $user->getId();
        $name = $user->getName();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $photo = $user->getPhoto();
        $role = $user->getRole();
        $status = $user->getStatus();

        $sql = "UPDATE users
                SET name = '$name', username = '$username', password = '$password', 
                    photo = '$photo', role = '$role', status = '$status'
                WHERE id = '$id'";

        if ($conn->query($sql) === true) {
            return true;
        }

        echo "Error: " . $sql . PHP_EOL;
        return false;
    }

    public function delete($id) {}

    public function checkExist($email)
    {
        $condition = "email = '$email' AND status = 1";
        $users = $this->fetchAll($condition);
        $user = current($users);

        return $user;
    }
}
