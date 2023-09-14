<?php

namespace Database\Seeders;

use App\Models\Association;
use App\Models\Value;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $association = Association::query()->create([
            'primary_title' => 'objective',
            'title' => 'الاهداف',
        ]);

        $values = [
            [
                'association_id' => $association->id,
                'title' => 'تقديم المساعدات للمرضى حسب حاجتهم بجميع جنسياتهم شاملة المساعدات المادية والعينية والأجهزة والمستلزمات الطبية والأدوية وتكاليف التشخيص والعلاج.'
            ],
            [
                'association_id' => $association->id,
                'title' => 'عمل زيارات دورية للمرضى في المرافق الصحية ومنازلهم للاطلاع على الخدمات المقدمة وتلمس احتياجاتهم والمساهم في تخفيف معاناتهم وتجديد الأمل في نفوسهم وزرع الابتسامة على شفاههم .'
            ],
            [
                'association_id' => $association->id,
                'title' => 'الاهتمام بالنواحي الاجتماعية للمرضى إلى جانب النواحي العلاجية انطلاقاً من مبدأ التكافل الاجتماعي.؛ 5- زرع الثقة المتبادلة والاطمئنان بين المريض والطبيب كأساس للعلاج السليم والاستجابة له.'
            ],
            [
                'association_id' => $association->id,
                'title' => 'العمل المستمر على رفع مستوى الخدمات الصحية المقدمة للمرضى والارتقاء بها كما وكيفا بدعم احتياجات المرافق الصحية أو الاقتراحات والآراء التي تساهم في تطوير العمل الصحي بما يحقق مصلحة المرضى.'
            ],
            [
                'association_id' => $association->id,
                'title' => 'تمثل الجمعية حلقة وصل بين مختلف الأجهزة وأهل الخير والمرضى وذلك بهدف دعم التواصل وإيصال التبرعات للمحتاجين توفيرا للجهد وتحقيقا للتكامل بين أفراد المجتمع.'
            ],
            [
                'association_id' => $association->id,
                'title' => 'تأمين وسائل النقل للمرضى الذين لا تتوفر لديهم وسائل النقل لاستكمال رحلة الشفاء.'
            ],
        ];

        foreach ($values as $value) {
            Value::query()->create($value);
        }
    }
}
