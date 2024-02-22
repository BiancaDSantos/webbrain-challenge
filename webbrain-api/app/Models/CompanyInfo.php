<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'street',
        'district',
        'zipCode',
        'city',
        'state',
        'OfficeHours',
        'numberPhone',
        'whatsapp',
        'whatsappLink',
        'mapsLink',
    ];
}
