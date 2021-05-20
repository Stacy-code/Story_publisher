<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @package App\Models
 */
class Story extends Model
{
    /**
     * @var string $table
     */
    public $table = 'story';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'author', 'email', 'title', 'content'
    ];

    /**
     * @var array $casts
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
