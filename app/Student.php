<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

/**
 * App\Student
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereUserId($value)
 * @mixin \Eloquent
 */
class Student extends Model
{
    protected $fillable = ['user_id', 'title'];
    //relacion de muchos a muchos en Course
    public function courses (){
        return $this->belongsToMany(Course::class);
    }
    public function user(){
        return $this->belongsTo(User::class)->select('id', 'role_id', 'name', 'email');
    }
}
