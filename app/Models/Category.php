<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'priority' => 'integer',
        'default' => 'boolean',
        'visible' => 'boolean'
    ];

    public function scopeVisibled(Builder $builder): Builder
    {
        return $builder->where(function (Builder $query) {
            $query->where('visible', true)
                ->orWhere('default', true);
        });
    }

}
