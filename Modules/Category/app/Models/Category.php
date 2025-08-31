<?php

namespace Modules\Category\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Announcement\Models\Announcement;
use Modules\Course\Models\Course;
use Modules\Product\Models\Product;
use Modules\Resume\Models\Resume;
use Modules\User\Models\User;

class Category extends Model
{
    use HasFactory,Sluggable;
    protected $guarded = [];

    protected $casts = ['image' => 'array'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function parent()
    {
        return $this->belongsTo(__CLASS__,'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(__CLASS__,'parent_id');
    }

    public function resumes()
    {
        return $this->belongsToMany(Resume::class);
    }

    public function announcements()
    {
        return $this->belongsToMany(Announcement::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
