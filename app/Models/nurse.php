<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class nurse extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "name",
        "email",
        "phone",
        "gender",
        "address",
        "qualification",
        "photo",
        "position",
        "registered",
    ];

    public function employee()
    {
        return $this->belongsTo(employee::class);
    }
}
