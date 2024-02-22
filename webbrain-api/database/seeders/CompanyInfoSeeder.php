<?php

namespace Database\Seeders;

use App\Models\CompanyInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function run(): void
    {
        CompanyInfo::create([
            'name' => 'Web Brain Tecnologia',
            'street' => 'Rua Duarte Costa, 865',
            'district' => 'Santa Barbara',
            'zipCode' => '88804-337',
            'city' => 'Criciúma',
            'state' => 'SC',
            'OfficeHours' => '08h até as 18h | Seg à Sex',
            'numberPhone' => '(48) 2102-7493',
            'whatsapp' => '(48) 2102-7493',
            'whatsappLink' => '554821027493',
            'mapsLink' => 'https://www.google.com.br/maps/place/R.+Duarte+da+Costa,+860+-+Michel,+Criciúma+-+SC,+88804-495/@-28.6905701,-49.3809402,17z/data=!3m1!4b1!4m6!3m5!1s0x9521826453f82997:0x2d5eb507829d991a!8m2!3d-28.6905748!4d-49.3783653!16s%2Fg%2F11f3dq3xjj?entry=tt'
        ]);
    }
}
