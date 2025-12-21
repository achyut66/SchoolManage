<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingSection extends Model
{
    use HasFactory;
    protected $table = "table_setting_sections_as_grade";
    protected $fillable = [
        'grade',
        'sections',
    ];

    public function gradeSetting()
    {
        return $this->belongsTo(
            GradeSetting::class,
            'grade',  // foreign key
            'name'    // owner key
        );
    }
}
