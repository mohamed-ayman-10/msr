<?php

namespace Database\Seeders;

use App\Models\Home;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $home = Home::query()->create([
            'who_are_we_title' => 'من نحن',
            'who_are_we_description' => 'جمعية أصدقاء المرضى بمحافظة عنيزة هي جمعية خيرية مسجلة بالمركز الوطني لتنمية القطاع الغير ربحي برقم 3625 وتاريخ 23 / 8 / 1442هـ وتهدف إلى تقديم المساعدات للمرضى حسب حاجتهم بجميع جنسياتهم شاملة المساعدات المادية والعينية والأجهزة والمستلزمات الطبية والأدوية وتكاليف التشخيص والعلاج والنقل إلى جانب الاهتمام بالنواحي الاجتماعية للمرضى انطلاقاً من مبدأ التكافل الاجتماعي',
            'who_are_we_video' => 'admin/images/video/WhatsApp-Video-2023-06-14-at-9.24.41-AM-1.mp4',
        ]);

        $image = new Image();
        $image->home_id = $home->id;
        $image->path = 'admin/images/slider/slider-1.png';
        $image->save();

        $image = new Image();
        $image->home_id = $home->id;
        $image->path = 'admin/images/slider/slider-2.jpeg';
        $image->save();

    }
}
