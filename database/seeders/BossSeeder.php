<?php

namespace Database\Seeders;

use App\Models\Association;
use App\Models\Image;
use App\Models\Plan;
use App\Models\Value;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BossSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $association = Association::query()->create([
            'primary_title' => 'boss',
            'title' => 'المدير التنفيذي',
            'name' => 'باسل بن محمد صالح أبا الخيل',
            'phone' => '0505488826',
            'email' => 'info@pf.org.sa',
            'address' => 'القصيم – عنيزة'
        ]);

            Image::query()->create([
                'association_id' => $association->id,
                'path' => 'image',
            ]);
    }
}
