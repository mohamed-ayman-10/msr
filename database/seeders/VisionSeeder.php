<?php

namespace Database\Seeders;

use App\Models\Association;
use App\Models\Value;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $association = Association::query()->create([
            'primary_title' => 'vision',
            'title' => 'الرؤية والرساله والقييم',
            'vision' => 'الريادة في الرعاية الشاملة للمرضى وتوعية المجتمع.',
            'message' => 'تحسين جودة حياة المريض بتلبية احتياجاته ورعايته نفسيا واجتماعيا وخلق مجتمع واعي وذلك عبر شراكات استراتيجية فعالة ووسائل مبتكرة.'
        ]);

        $values = [
            [
                'association_id' => $association->id,
                'title' => 'الالتزام'
            ],
            [
                'association_id' => $association->id,
                'title' => 'الحياد'
            ],
            [
                'association_id' => $association->id,
                'title' => 'الإبداع'
            ],
            [
                'association_id' => $association->id,
                'title' => 'العطاء'
            ],
            [
                'association_id' => $association->id,
                'title' => 'الشفافية'
            ],
            [
                'association_id' => $association->id,
                'title' => 'السرية'
            ],
        ];

        foreach ($values as $value) {
            Value::query()->create($value);
        }
    }
}
