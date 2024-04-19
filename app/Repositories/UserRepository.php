<?php
namespace App\Repositories;
use Illuminate\Support\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    private string $tableName = "users";


    public function insert(User $user)
    {
        $sql = "INSERT INTO $this->tableName (id, role, name, email, password, phone, address, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        DB::insert($sql, [
            $user->getId(),
            $user->getRole()->getValue(),
            $user->getFullname(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getPhone(),
            $user->getAddress(),
            Carbon::now(),
            Carbon::now()
        ]);
    }
    public function selectAll()
    {
    }

    public function update(User $model)
    {
    }

    public function delete(string $id)
    {
    }
    

    public function findByEmail($email)
    {
        $result = DB::select("SELECT * FROM users
        WHERE email = ? LIMIT 1", [$email]);

        if (!empty($result)) {
            $newUser = $result[0];
            if ($newUser->role == "admin") {
                $role = Role::Admin;
            } elseif ($newUser->role == "doctor") {
                $role = Role::Doctor;
            } else {
                $role = Role::Patient;
            }
            return new User(
                $role,
                $newUser->email,
                $newUser->password,
                $newUser->name,
                $newUser->phone == null ? "" : $newUser->phone,
                $newUser->address == null ? "" : $newUser->address,
                $newUser->url_image == null ? "" : $newUser->url_image
            );
        }
        return null;
    }
    function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    function validatePassword($password)
    {
        if (strlen($password) < 6) {
            return false;
        }
        if (!preg_match("/^(?=.*[!@#$%^&*])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/", $password)) {
            return false;
        }
        return true;
    }

    function validateFullName($fullName)
    {
        if (strlen($fullName) < 2) {
            return false;
        }
        return true;
    }
    public function validatePhone($phone)
    {
        $phonePattern = "/^\d{10}$/";
        if (!preg_match($phonePattern, $phone)) {
            return false;
        }
        return true;
    }
    public function validateAddress($address)
    {
        if (strlen($address) < 5) {
            return false;
        }
        return true;
    }

}