<?php

namespace Database\Seeders;

use App\Models\InternationalId;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternationalIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InternationalId::truncate();
        $data = [
            [
                'name' => 'Licence',
            ],
            [
                'name' => 'Passport',
            ],
            [
                'name' => 'Rego',
            ],
        ];

        foreach ($data as $international_id) {
            (new InternationalId())->create($international_id);
        }
    }
}
