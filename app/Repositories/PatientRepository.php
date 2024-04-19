<?php

namespace App\Repositories;
use App\Models\Booking;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Reference\Reference;
use App\Models\User;


class PatientRepository
{
    private string $tableName = "patients";

    public function add_new_patient(Patient $patient)
    {
        $sql = "INSERT INTO $this->tableName (id, user_id, health_condition, note) VALUES (?, ?, ?, ?)";
        DB::insert($sql, [
            $patient->getId(),
            $patient->getId(),
            $patient->getHealthCondition(),
            $patient->getNote()
        ]);
    }

    public function insertCart(Booking $booking)
    {
        $sql = "INSERT INTO add_to_cart (id,patient_id,doctor_id,date_booking,time_id) VALUES (?, ?, ?, ?, ?)";
        DB::insert($sql, [
            $booking->getId(),
            $booking->getPatientId(),
            $booking->getDocterId(),
            $booking->getDate(),
            $booking->getTimeId()
        ]);
    }

    public function insert(Patient $patient)
    {
        $sql = "INSERT INTO $this->tableName (id, user_id, health_condition, note) VALUES (?, ? , ?, ?)";
        DB::insert($sql, [
            $patient->getId(),
            $patient->getId(),
            $patient->getHealthCondition(),
            $patient->getNote()
        ]);
    }

    public function insertGoogle($id)
    {
        $sql = "SELECT id FROM UsersLoginGoogle WHERE id = ?";
        $existingId = DB::selectOne($sql, [$id]);
    
        if (!$existingId) {
            $insertSql = "INSERT INTO UsersLoginGoogle (id) VALUES (?)";
            DB::insert($insertSql, [$id]);
        }
    }
    
     
    public function get_info_patients()
    {
        $sql = "SELECT u.url_image, u.name, u.email, u.phone, u.address, p.health_condition, p.note, p.user_id
        FROM $this->tableName p
        JOIN users u ON p.user_id = u.id;";
        return DB::select($sql); 
    }
    public function findByEmail($email)
    {
        $result = DB::select("SELECT * FROM users
        WHERE email = ? LIMIT 1", [$email]);
        $newUser = $result[0];
        return $newUser->id;
    }

    public function getTimeId($id){
        $result = DB::select("SELECT time_start, time_end, price 
        FROM list_time_doctor 
        WHERE id = ?", [$id]);
        return $result;     
    }

    public function get_patient_by_id($id)
    {
        $sql = "SELECT p.user_id, u.name, u.email, u.password, u.phone, u.address, u.url_image, p.health_condition, p.note
                FROM patients p
                JOIN users u ON p.user_id = u.id
                WHERE p.user_id = :id";
        
        $patient = DB::select($sql, ['id' => $id]);
    
        return $patient;
    }

    public function delete_patient(string $userId): bool
{
    // Lấy ID bệnh nhân từ bảng patients
    $patientId = DB::table('patients')->where('user_id', $userId)->value('id');

    // Xóa hàng trong bảng patients
    DB::table('patients')->where('id', $patientId)->delete();

    // Xóa hàng trong bảng users
    DB::table('users')->where('id', $userId)->delete();

    return true; // Trả về true nếu xóa thành công
}

public function update_patient(User $user, Patient $patient)
{
    $user_sql = "UPDATE users SET name = ?, password = ?, phone = ?, address = ? WHERE id = ?";
    $patient_sql = "UPDATE patients SET health_condition = ?, note = ?  WHERE user_id = ?";
     
    $user = DB::update($user_sql, [
        $user->getFullName(),
        $user->getPassword(),
        $user->getPhone(),
        $user->getAddress(),
        $patient->getUserId()
    ]);

    $patient= DB::update($patient_sql, [
        $patient->getHealthCondition(),
        $patient->getNote(),
        $patient->getUserId()
    ]);

    return $patient;
}

}