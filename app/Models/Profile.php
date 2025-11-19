<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id','nama','tanggal_lahir','jenis_kelamin',
        'pendidikan_terakhir','pengalaman_kerja','email','whatsapp','cv_path'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function applications() { return $this->hasMany(Application::class); }
    public function savedJobs() { return $this->hasMany(SavedJob::class); }
}
