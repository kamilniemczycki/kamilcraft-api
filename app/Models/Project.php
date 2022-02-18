<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int $id
 * @property string $title
 * @property array $categories
 * @property string $author
 * @property array $images
 * @property Carbon $release_date
 * @property Carbon $update_date
 * @property string $project_url
 * @property string $project_version
 * @property string $description
 */
class Project extends Model
{

    // use HasFactory;

    protected $dateFormat = 'Y-m-d';

    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'categories' => 'array',
        'author' => 'string',
        'images' => 'array',
        'release_date' => 'datetime:Y-m-d',
        'update_date' => 'datetime:Y-m-d',
        'project_url' => 'string',
        'project_version' => 'string',
        'description' => 'string',
        'visible' => 'boolean'
    ];

    public function getReleaseDateAttribute($value): String
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function setReleaseDateAttribute($value): void
    {
        $this->attributes['release_date'] = $value;
    }

    public function getUpdateDateAttribute($value): String|null
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function setUpdateDateAttribute($value): void
    {
        if (!is_null($value))
            $this->attributes['update_date'] = $value;
        else
            $this->attributes['update_date'] = null;
    }

    public function scopeVisibled(Builder $builder)
    {
        return $builder->where('visible', true);
    }

}
