<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @package App\Models
 */
class Post extends Model
{
    /**
     * @var string $table
     */
    public $table = 'post';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'title', 'author', 'content'
    ];

    /**
     * @var array $casts
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
