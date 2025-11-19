<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $fillable = [
        'company_id','nama_pekerjaan','jenis_pekerjaan',
        'pengalaman_minimal','pendidikan_minimal','gaji','deskripsi_kualifikasi'
    ];

    public function company() { return $this->belongsTo(Company::class); }
    public function applications() { return $this->hasMany(Application::class); }
    public function savedByUsers() { return $this->hasMany(SavedJob::class); }
}
