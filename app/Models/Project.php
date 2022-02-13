<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property array $categories
 * @property string $author
 * @property string $image_url
 * @property Carbon $release_data
 * @property string $project_url
 * @property string $project_version
 * @property string $description
 */
class Project extends Model
{

    // use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'categories' => 'array',
        'author' => 'string',
        'image_url' => 'string',
        'release_data' => 'datetime:d-m-Y',
        'project_url' => 'string',
        'project_version' => 'string',
        'description' => 'string'
    ];

}
