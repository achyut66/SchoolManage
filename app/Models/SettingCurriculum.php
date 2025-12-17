<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingCurriculum extends Model
{
    use HasFactory;
    protected $table = 'table_setting_curriculum';
    protected $fillable = [
        'grade',
        'subjects'
    ];

    public function grade()
    {
        return $this->belongsTo(GradeSetting::class, 'grade');
    }
}
