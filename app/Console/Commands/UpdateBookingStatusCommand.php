<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateBookingStatusCommand extends Command
{
    protected $signature = 'booking:update-status';
    protected $description = 'Update the status of bookings based on time';

    public function handle()
    {
        $currentDateTime = Carbon::now();

        DB::beginTransaction();

        try {
            $bookings = DB::table('bookings')
                ->where('status', 'processing')
                ->where('date_booking', '<=', $currentDateTime)
                ->join('list_time_doctor', 'list_time_doctor.id', '=', 'bookings.time_id')
                ->where('list_time_doctor.time_end', '<=', $currentDateTime)
                ->lockForUpdate()
                ->get();

            foreach ($bookings as $booking) {
                DB::table('bookings')
                    ->where('id', $booking->id)                    ->update(['status' => 'completed']);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating booking status: ' . $e->getMessage());
        }

        $this->info('Booking status updated successfully.');
    }
}