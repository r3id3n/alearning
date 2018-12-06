<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\requirement
 *
 * @property int $id
 * @property int $course_id
 * @property string $requirement
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\requirement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\requirement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\requirement query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\requirement whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\requirement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\requirement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\requirement whereRequirement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\requirement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class requirement extends Model
{
    //
    public function courses(){
        return $this->belongsTo(Course::class);
    }
}
