<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactOptions extends Model
{
    use HasFactory;

    protected $fillable = ['description'];

    public function Contact()
    {
        return $this->belongsToMany(Contact::class, 'contact_contact_options');
    }
}
