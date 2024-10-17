<?php

namespace Database\Seeders;

use App\Models\PageSetting\PageSetting;
use App\Models\PageSetting\PageSettingType;
use App\Models\SocialMedia\SocialMedia;
use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PageSettingType::create([
            'id' => 1 ,
            'title' => 'متن'
        ]);

        PageSettingType::create([
            'id' => 2 ,
            'title' => 'فایل'
        ]);

        PageSetting::create([
            'title' => 'عنوان سایت',
            'key' => 'main_title' ,
            'page_setting_type_id' => 1 ,
            'default' => 'بنیاد مصطفی'
        ]);

        PageSetting::create([
            'title' => 'لوگوی وبسایت',
            'key' => 'main_logo' ,
            'page_setting_type_id' => 2 ,
            'default' => '/mmwdali-profile.png'
        ]);
    }
}
