<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'email_perusahaan',
        'negara',
        'alamat_perusahaan',
        'nomor_telepon',
        'about',
        'logo',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function jobListings() { return $this->hasMany(JobListing::class); }
}
