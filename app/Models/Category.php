<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property bool $default
 * @property bool $visible
 */
class Category extends Model
{
    // use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'priority' => 'integer',
        'default' => 'bool',
        'visible' => 'bool'
    ];
}
