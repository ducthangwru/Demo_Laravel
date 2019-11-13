<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package App\Models
 * @property string $content
 * @property int $user_id
 */
class Post extends Model
{
    protected $fillable = ['content', 'user_id'];
}
