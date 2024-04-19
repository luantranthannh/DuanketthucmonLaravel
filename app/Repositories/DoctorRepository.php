<?php

namespace App\Repositories;

use App\Models\Doctor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Favorite;

class DoctorRepository
{
    private string $tableName = "doctors";

    public function insert_doctor(Doctor $doctor)
    {
        $sql = "INSERT INTO $this->tableName (id, user_id, specialization, description, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)";
        DB::insert($sql, [
            $doctor->getId(),
            $doctor->getId(),
            $doctor->specialization,
            $doctor->description,
            Carbon::now(),
            Carbon::now(),

        ]);
    }


    public function getAllTimeDoctor()
    {
        $query = "SELECT time_start, time_end FROM list_time_doctor";
        $result = DB::select($query);
        return $result;
    }

    public function getAllDoctor()
    {
        $query = "SELECT  users.id AS user_id, users.id, users.email, users.name, users.phone, users.password,
        users.address, users.url_image, doctors.id, doctors.specialization, doctors.description
        FROM users
        JOIN doctors ON users.id = doctors.user_id
        WHERE users.role = 'doctor'";

        $result = DB::select($query);
        return $result;
    }

    public function getDoctorById(string $id)
    {
        $query = "SELECT users.id AS user_id, users.email, users.name, users.phone, users.address, users.password, users.url_image, doctors.specialization, doctors.description
          FROM users
          JOIN doctors ON users.id = doctors.user_id
          WHERE users.role = 'doctor' AND doctors.id = '$id'";
        $result = DB::select($query);
        return $result;
    }
    public function getAvailableTimesForBooking($selectedDate, $Doctorid)
    {
        $query = "SELECT list_time_doctor.id, list_time_doctor.time_start, list_time_doctor.time_end, list_time_doctor.price
        FROM list_time_doctor
        LEFT JOIN booking ON list_time_doctor.id = booking.time_id AND booking.date_booking = ? AND booking.doctor_id = ?
        WHERE booking.time_id IS NULL";

        $result = DB::select($query, [$selectedDate, $Doctorid]);
        return $result;
    }
    public function searchDoctors($searchTerm)
    {
        $res = new DoctorRepository();
        $doctors = $res->getAllDoctor();
        $results = array();

        foreach ($doctors as $doctor) {
            $fullName = $doctor->name;
            if (strpos($fullName, $searchTerm) !== false) {
                $results[] = $doctor;
            }
        }
        return $results;
    }
    public function getAllFavoriteDoctors()
    {
        $favoriteDoctors = Favorite::join('doctors', 'favorites.doctor_id', '=', 'doctors.id')
            ->join('users', 'doctors.user_id', '=', 'users.id')
            ->where('users.role', '=', 'doctor')
            ->select('favorites.id', 'users.name as doctor_name', 'users.email as doctor_email', 'users.phone as doctor_phone', 'doctors.specialization as doctor_spec')
            ->get();

        return $favoriteDoctors;
    }

    /**
     * 
     * Handle store favorite doctor
     * 
     * @param int $userId
     * @param int $doctorId
     * 
     * @return boolean
     */
    public function storeFavoriteDoctor(int $userId, int $doctorId): bool
    {

        try {
            DB::beginTransaction();
            // Kiểm tra user đã thích bác sĩ hay chưa, nếu chưa thì yêu thích, rồi thì bỏ thích
            $check = Favorite::where('user_id', $userId)->where('doctor_id', $doctorId)->first();
            if ($check == false) {
                Favorite::create([
                    'user_id' => $userId,
                    'doctor_id' => $doctorId
                ]);
            } else {
                $check->delete();
            }
            DB::commit();

            return true;
        } catch (\Throwable $th) {
            DB::rollBack();

            return false;
        }
    }

    public function selectPsychoD()
    {
        $Psycho_doctor = DB::select("SELECT  users.id AS user_id, users.id, users.email, users.name, users.phone, users.password,
        users.address, users.url_image, doctors.id, doctors.specialization, doctors.description
        FROM users
        JOIN doctors ON users.id = doctors.user_id
        WHERE users.role = 'doctor' AND doctors.specialization = 'Psycho Doctor'");

        return $Psycho_doctor;
    }

    public function selectPsychologistsD()
    {
        $psychologists = DB::select("SELECT  users.id AS user_id, users.id, users.email, users.name, users.phone, users.password,
        users.address, users.url_image, doctors.id, doctors.specialization, doctors.description
        FROM users
        JOIN doctors ON users.id = doctors.user_id
        WHERE users.role = 'doctor' AND doctors.specialization = 'Psychologists'");

        return $psychologists;
    }

    public function selectNeurologistD()
    {
        $neurologists = DB::select("SELECT  users.id AS user_id, users.id, users.email, users.name, users.phone, users.password,
        users.address, users.url_image, doctors.id, doctors.specialization, doctors.description
        FROM users
        JOIN doctors ON users.id = doctors.user_id
        WHERE users.role = 'doctor' AND doctors.specialization = 'Neurologist'");

        return $neurologists;
    }

    public function typeDoctors()
    {
        $type = DB::select("SELECT DISTINCT specialization FROM doctors;");
        return $type;
    }
}
