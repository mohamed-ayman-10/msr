<?php

namespace Database\Seeders;

use App\Models\Association;
use App\Models\Plan;
use App\Models\Value;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $association = Association::query()->create([
            'primary_title' => 'plan',
            'title' => 'الخطط والأهداف التشغيلية',
        ]);

        $plans = [
            [
                'association_id' => $association->id,
                'title' => 'الخطة التشغيلية',
                'name' => 'الخطة التشغيلية لعام 2021م',
                'pdf' => 'pdf'
            ],
            [
                'association_id' => $association->id,
                'title' => 'الخطة الاستراتيجية',
                'name' => 'الخطة الاستراتيجية لعام 2024-2022',
                'pdf' => 'pdf'
            ],
            [
                'association_id' => $association->id,
                'title' => 'الخطة التشغيلية',
                'name' => 'الخطة التشغيلية لعام 2022م',
                'pdf' => 'pdf'
            ],
            [
                'association_id' => $association->id,
                'title' => 'الخطة التشغيلية',
                'name' => 'الخطة التشغيلية لعام 2023م',
                'pdf' => 'pdf'
            ],
        ];

        foreach ($plans as $plan) {
            Plan::query()->create($plan);
        }
    }
}
