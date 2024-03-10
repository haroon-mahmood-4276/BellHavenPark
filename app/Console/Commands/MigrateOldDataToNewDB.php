<?php

namespace App\Console\Commands;

use App\Models\{Booking, Cabin, Customer, Permission, Role, User};
use App\Utils\Enums\CabinStatus;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MigrateOldDataToNewDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:old-data-to-new-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        // Migrate Roles
        $this->newLine();
        $this->info('Importing Roles');
        (new Role())->truncate();
        $this->withProgressBar(DB::connection('sqlsrv')->table('Security_Level')->whereNotIn('Description', ['Owner'])->get(), function ($sqlModel) {
            (new Role())->create([
                'parent_id' => ($sqlModel->Description === 'Admin') ? 0 : 1,
                'name' => $sqlModel->Description,
                'guard_name' => 'web',
            ]);
        });
        $this->newLine();

        // Assigning Permission to Role 
        $this->newLine();
        $this->info('Assigning Permission to Role');
        $role = Role::first();
        $this->withProgressBar(Permission::all(), function ($permission) use ($role) {
            $role->givePermissionTo($permission);
        });
        $this->newLine();

        // Migrate Users
        $this->newLine();
        $this->info('Importing Users');
        (new User())->truncate();
        (new User())->create([
            'name' => 'Admin',
            'email' => 'admin@bellhaven.com.au',
            'email_verified_at' => now()->timestamp,
            'password' => Hash::make('admin@bellhaven'),
            'remember_token' => Str::random(10),
        ]);
        $this->withProgressBar(DB::connection('sqlsrv')->table('Staff')->get(), function ($sqlModel) {
            (new User())->create([
                'name' => $sqlModel->Full_Name,
                'email' => Str::of($sqlModel->Full_Name)->lower()->replace(' ', '_') . '@bellhaven.com.au',
                'email_verified_at' => now()->timestamp,
                'password' => Hash::make($sqlModel->Password),
                'remember_token' => Str::random(10),
            ]);
        });
        $this->newLine();

        // Assigning Admin Role to Admin User 
        $this->newLine();
        $this->info('Assigning Role to Admin User ');
        $this->withProgressBar(1, function ($sqlModel) {
            (User::first())->assignRole(Role::first());
        });
        $this->newLine();

        // Migrate Customers
        $this->newLine();
        $this->info('Importing Customers');
        (new Customer())->truncate();
        $this->withProgressBar(DB::connection('sqlsrv')->table('Customers')->get(), function ($sqlModel) {
            (new Customer())->insert([
                'id' => intval($sqlModel->Customer_ID),
                'first_name' => trim($sqlModel->First_Name),
                'last_name' => trim($sqlModel->Last_Name),
                'email' => $sqlModel->Email ?: null,
                'dob' => $sqlModel->DOB ? Carbon::parse($sqlModel->DOB)->startOfDay()->timestamp : null,
                'phone' => $sqlModel->Mobile ?: null,
                'telephone' => $sqlModel->Telephone ?: null,
                'international_id_id' => $sqlModel->ID_Type ? intval($sqlModel->ID_Type) : null,
                'international_details' => $sqlModel->ID_Details ?: null,
                'international_address' => $sqlModel->ID_Address ?: null,
                'comments' => $sqlModel->Comments ?: null,
                'average_rating' => 0,
                'address' => $sqlModel->Address ?: null,
                'referenced_by' => null,
                'created_at' => now()->timestamp,
                'updated_at' => $sqlModel->Date_Modified ? Carbon::parse($sqlModel->Date_Modified)->timestamp : now()->timestamp,
            ]);
        });
        $this->newLine();

        // Migrate Cabins
        $this->newLine();
        $this->info('Importing Cabins');
        (new Cabin())->truncate();
        DB::transaction(function () {
            $this->withProgressBar(DB::connection('sqlsrv')->table('Cabins')->get(), function ($sqlModel) {
                // dd($sqlModel);
                (new Cabin())->insert([
                    'name' => trim('Cabin ' . $sqlModel->ID),
                    'cabin_type_id' => intval($sqlModel->Cabin_Type),
                    'cabin_status' => match (intval($sqlModel->Cabin_Status)) {
                        1 => CabinStatus::OCCUPIED,
                        2 => CabinStatus::VACANT,
                        3 => CabinStatus::CLOSED_PERMANENTLY
                    },
                    'closed_from' => now()->timestamp,
                    'closed_to' => now()->timestamp,
                    'long_term' => boolval($sqlModel->Long_Term),
                    'electric_meter' => boolval($sqlModel->MeterElec),
                    'created_at' => now()->timestamp,
                    'updated_at' => $sqlModel->Date_Modified ? Carbon::parse($sqlModel->Date_Modified)->timestamp : now()->timestamp,
                ]);
            });
        });
        $this->newLine();

        // Migrate Bookings
        $this->newLine();
        $this->info('Importing Bookings');
        (new Booking())->truncate();
        $this->withProgressBar(DB::connection('sqlsrv')->table('Bookings')->get(), function ($sqlModel) {
            // dd($sqlModel);
            try {
                $cabin = (new Cabin())->where('name', 'Cabin ' . intval($sqlModel->Cabin_Id))->first();

                if (!$cabin)
                    return;

                (new Booking())->insert([
                    'cabin_id' => $cabin->id,
                    'customer_id' => intval($sqlModel->Customer_Id),
                    'booking_number' => intval($sqlModel->Booking_Id),
                    'booking_from' => !is_null($sqlModel->Book_From) ? Carbon::parse($sqlModel->Book_From)->startOfDay()->timestamp : 0,
                    'booking_to' => !is_null($sqlModel->Book_To) ? Carbon::parse($sqlModel->Book_To)->startOfDay()->timestamp : 0,
                    'booking_source_id' => $sqlModel->Booking_Source_Id ? intval($sqlModel->Booking_Source_Id) : null,
                    'daily_rate' => floatval($sqlModel->Daily_Rate) > 0 ? floatval($sqlModel->Daily_Rate) : 0,
                    'daily_less_booking_percentage' => 0,
                    'weekly_rate' => floatval($sqlModel->Weekly_Rate) > 0 ? floatval($sqlModel->Weekly_Rate) : 0,
                    'weekly_rate_less_booking_percentage' => 0,
                    'four_weekly_rate' => 0,
                    'four_weekly_less_booking_percentage' => 0,
                    'check_in' => (Carbon::parse($sqlModel->Booking_date)->startOfDay()->diff(Carbon::parse($sqlModel->Check_In)->startOfDay())->days > 1) ? 'now' : 'later',
                    'check_in_date' => $sqlModel->Check_In ? Carbon::parse($sqlModel->Check_In)->timestamp : 0,
                    'check_out_date' => $sqlModel->Check_Out ? Carbon::parse($sqlModel->Check_Out)->timestamp : 0,
                    'booking_tax_id' => 2,
                    'status' => 1,
                    'comments' => null,
                    'payment' => 'later',
                    'created_at' => Carbon::parse($sqlModel->Booking_date)->timestamp,
                ]);
            } catch (Exception $ex) {
                Log::info($ex);
            }
        });
        $this->newLine();
    }
}
