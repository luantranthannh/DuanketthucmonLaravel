<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class BookingRepository
{
    private string $tableName = "booking";

    public function insert(Booking $booking)
    {
        $sql = "INSERT INTO $this->tableName (id,patient_id,doctor_id,date_booking,time_id) VALUES (?, ?, ?, ?, ?)";
        DB::insert($sql, [
            $booking->getId(),
            $booking->getPatientId(),
            $booking->getDocterId(),
            $booking->getDate(),
            $booking->getTimeId()
        ]);
    }

    public function check()
    {
        $duplicates = DB::table('booking')
            ->select('doctor_id', 'date_booking', 'time_id')
            ->groupBy('doctor_id', 'date_booking', 'time_id')
            ->get();

        foreach ($duplicates as $duplicate) {
            DB::table('add_to_cart')
                ->where('doctor_id', $duplicate->doctor_id)
                ->where('date_booking', $duplicate->date_booking)
                ->where('time_id', $duplicate->time_id)
                ->delete();
        }
    }

    public function selectAll()
    {
        $bookings = "SELECT * FROM $this->tableName";

        return $bookings;
    }

    public function get_patient_id($email)
    {
        $user = DB::select('SELECT id FROM users WHERE email = ? LIMIT 1', [$email]);

        if (!empty($user)) {
            $userId = $user[0]->id;

            $patient = DB::select('SELECT id FROM patients WHERE user_id = ?', [$userId]);

            if (!empty($patient)) {
                $patientId = $patient[0]->id;

                $bookings = DB::select('SELECT b.id, b.patient_id, b.doctor_id, b.date_booking, b.time_id, u.email, u.name, u.phone, t.time_start, t.price
                FROM booking b  
                INNER JOIN doctors d ON b.doctor_id = d.id
                INNER JOIN users u ON d.user_id = u.id
                INNER JOIN list_time_doctor t ON b.time_id = t.id
                WHERE b.patient_id = ?', [$patientId]);

                if (!empty($bookings)) {
                    return $bookings;
                } else {
                    return "No record found in booking table";
                }
            } else {
                return "No records found in patients table";
            }
        } else {
            return "No user found with this email";
        }
    }
}