<?php

namespace Database\Seeders;

use App\Models\InternationalId;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InternationalIdSeeder extends Seeder
{
    use WithoutModelEvents;

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
                'slug' => Str::of('Licence')->slug(),
            ],
            [
                'name' => 'Passport',
                'slug' => Str::of('Passport')->slug(),
            ],
            [
                'name' => 'Rego',
                'slug' => Str::of('Rego')->slug(),
            ],
        ];

        foreach ($data as $international_id) {
            (new InternationalId())->create($international_id);
        }
    }
}
