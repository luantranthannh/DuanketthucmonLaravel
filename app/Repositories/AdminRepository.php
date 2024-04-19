<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Patient;
use Illuminate\Contracts\Auth\UserProvider;

class AdminRepository
{
    // for doctors
    public function addNewDoctor(User $doctor)
    {
        $userSql = "INSERT INTO users (id, role, email, password, name, phone, address, url_image, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $doctor = DB::insert($userSql, [
            $doctor->getId(),
            $doctor->getRole()->getValue(),
            $doctor->getEmail(),
            $doctor->getPassword(),
            $doctor->getFullName(),
            $doctor->getPhone(),
            $doctor->getAddress(),
            $doctor->getUrlImage(),
            Carbon::now(),
            Carbon::now()
        ]);
        return $doctor;
    }

    public function updateDoctor(User $user, Doctor $doctor)
    {
        $userSql = "UPDATE users
        SET name = ?, password = ?, phone = ?, address = ?, url_image = ?, email = ?, created_at = ?, updated_at = ? WHERE id = ?";

        $userSqldoctor = "UPDATE doctors SET specialization = ?, description = ? , created_at = ?, updated_at = ? WHERE user_id = ?";

        $userSql = DB::update($userSql, [
            $user->getFullName(),
            $user->getPassword(),
            $user->getPhone(),
            $user->getAddress(),
            $user->getUrlImage(),
            $user->getEmail(),
            Carbon::now(),
            Carbon::now(),
            $doctor->getUserId()
        ]);


        DB::update($userSqldoctor, [
            $doctor->getSpecialization(),
            $doctor->getDescription(),
            Carbon::now(),
            Carbon::now(),
            $doctor->getUserId(),
        ]);
        return $userSql;
    }

    public function deleteDoctor($id)
{
    $userId = DB::table('doctors')->where('id', $id)->value('user_id');
    try {
        DB::table('doctors')->where('id', $id)->delete();
        DB::table('users')->where('id', $userId)->delete();
        return redirect('admin/doctors')->with('success', 'Doctor has been blocked successfully!');
    } catch (\Illuminate\Database\QueryException $e) {
        return redirect('admin/doctors')->with('error', 'Cannot block a doctor');
    }
}


    public function edit($id)
    {
    }


    public function add_new_user(User $user)
    {
        $user_sql = "INSERT INTO users (id, role, email, password, name, phone, address, url_image)VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $user = DB::insert($user_sql, [
            $user->getId(),
            $user->getRole()->getValue(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getFullName(),
            $user->getPhone(),
            $user->getAddress(),
            $user->getUrlImage()
        ]);

        return $user;
    }

    public function update_patient(User $user, Patient $patient)
    {
        $user_sql = "UPDATE users SET name = ?, password = ?, phone = ?, address = ? , url_image = ?  WHERE id = ?";
        $patient_sql = "UPDATE patients SET health_condition = ?, note = ?  WHERE user_id = ?";
         
        $user = DB::update($user_sql, [
            $user->getFullName(),
            $user->getPassword(),
            $user->getPhone(),
            $user->getAddress(),
            $user->getUrlImage(),
            $patient->getUserId()
        ]);

        $patient= DB::update($patient_sql, [
            $patient->getHealthCondition(),
            $patient->getNote(),
            $patient->getUserId()
        ]);

        return $patient;
    }

    public function get_appointments(){
        $appointments =  DB::table('booking')
        ->join('patients', 'booking.patient_id', '=', 'patients.id')
        ->join('doctors', 'booking.doctor_id', '=', 'doctors.id')
        ->join('users AS p', 'patients.user_id', '=', 'p.id')
        ->join('users AS d', 'doctors.user_id', '=', 'd.id')
        ->join('list_time_doctor AS ltd', 'booking.time_id', '=', 'ltd.id')
        ->select(
            'p.name AS patient_name',
            'p.phone AS patient_phone',
            'd.name AS doctor_name',
            'd.phone AS doctor_phone',
            'ltd.time_start AS time_start',
            'ltd.time_end AS time_end',
            'booking.date_booking AS date_booking',
            'booking.id AS id',
            'booking.status AS status',
            'patients.health_condition AS health_condition',
            'patients.note AS note'
        )
        ->get();
        return $appointments;
    }

    public function updateBookingStatus($id, $newStatus)
    {
        // Tìm booking theo ID
        $booking = DB::table('booking')->find($id);
    
        if ($booking) {
            // Cập nhật trạng thái
            DB::table('booking')
                ->where('id', $id)
                ->update(['status' => $newStatus]);
    
            return true;
        }
    
        return false;
    }


    public function search_patient($search)
    {
        $results = DB::table('users')
        ->select('users.id AS user_id', 'users.name', 'users.email', 'users.phone', 'users.address', 'users.url_image', DB::raw('MAX(patients.health_condition) as health_condition'), DB::raw('MAX(patients.note) as note'))
        ->leftJoin('patients', 'users.id', '=', 'patients.user_id')
        ->where(function ($query) use ($search) {
            $query->where('users.name', 'like', "%$search%")
                ->orWhere('users.email', 'like', "%$search%")
                ->orWhere('users.phone', 'like', "%$search%")
                ->orWhere('users.address', 'like', "%$search%")
                ->orWhere('patients.health_condition', 'like', "%$search%")
                ->orWhere('patients.note', 'like', "%$search%");
        })
        ->where('users.role', 'patient') 
        ->groupBy('users.id', 'users.name', 'users.email', 'users.phone', 'users.address')
        ->get();

    return $results;
    }


    function get_appointments_by_doctor()
    
    {   $topDoctors = DB::table('doctors')
                ->join('booking', 'doctors.id', '=', 'booking.doctor_id')
                ->join('users', 'doctors.user_id', '=', 'users.id')
                ->select('doctors.id', 'users.name', DB::raw('count(*) as total_bookings'))
                ->groupBy('doctors.id', 'users.name')
                ->orderByDesc('total_bookings')
                ->limit(10)
                ->get();
        return $topDoctors;
    }

    public function search_doctor($search)
{
    $results = DB::table('users')
        ->select('users.id AS user_id', 'users.name', 'users.email', 'users.phone', 'users.address', 'users.url_image', DB::raw('MAX(doctors.specialization) as specialization'), DB::raw('MAX(doctors.description) as description'))
        ->leftJoin('doctors', 'users.id', '=', 'doctors.user_id')
        ->where(function ($query) use ($search) {
            $query->where('users.name', 'like', "%$search%")
                ->orWhere('users.email', 'like', "%$search%")
                ->orWhere('users.phone', 'like', "%$search%")
                ->orWhere('users.address', 'like', "%$search%")
                ->orWhere('doctors.specialization', 'like', "%$search%")
                ->orWhere('doctors.description', 'like', "%$search%");
        })
        ->where('users.role', 'doctor') 
        ->groupBy('users.id', 'users.name', 'users.email', 'users.phone', 'users.address')
        ->get();

    return $results;
}

    public function delete_patient($id)
    {
        $userId = DB::table('patients')->where('id', $id)->value('user_id');
        try {
            DB::table('patients')->where('id', $id)->delete();
            DB::table('users')->where('id', $userId)->delete();
            return redirect('admin/patients')->with('success', 'Patient has been blocked successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('admin/patients')->with('error', 'Cannot block a patient');
        }
    }
}