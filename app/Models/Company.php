<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['user_id','nama_perusahaan','alamat_perusahaan'];

    public function user() { return $this->belongsTo(User::class); }
    public function jobListings() { return $this->hasMany(JobListing::class); }
}
