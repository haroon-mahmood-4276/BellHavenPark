<?php

namespace App\Console\Commands;

use App\Models\{Customer, Permission, Role, User};
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
                'first_name' => trim($sqlModel->First_Name),
                'last_name' => trim($sqlModel->Last_Name),
                'email' => $sqlModel->Email ?: null,
                'dob' => $sqlModel->DOB ? Carbon::parse($sqlModel->DOB)->startOfDay()->timestamp: null,
                'phone' => $sqlModel->Mobile ?: null,
                'telephone' => $sqlModel->Telephone ?: null,
                'international_id_id' => $sqlModel->ID_Type ? intval($sqlModel->ID_Type): null,
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
    }
}
// +"Customer_ID": "1"
//   +"Last_Name": "Balcombe"
//   +"First_Name": "Wanda"
//   +"Address": ""
//   +"Email": null
//   +"Telephone": null
//   +"Mobile": null
//   +"ID_Type": "1"
//   +"ID_Details": ""
//   +"ID_Address": null
//   +"Comments": null
//   +"Date_Modified": "2012-09-12 21:32:59"
//   +"SSMA_TimeStamp": b"\x00\x00\x00\x00\x00\x04øÄ"
//   +"Waiting": null
//   +"DOB": null