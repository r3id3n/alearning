<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Course
 *
 * @property int $id
 * @property int $teacher_id
 * @property int $category_id
 * @property int $level_id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property string|null $picture
 * @property string $status
 * @property int $previous_approved
 * @property int $previous_rejected
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePreviousApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePreviousRejected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Course extends Model
{
    const PUBLISHED = 1;
	const PENDING = 2;
	const REJECTED = 3;

	protected $withCount = ['reviews', 'students'];

	//Se incluye un metodo para tener acceso a las instancias
	public function pathAttachment(){
		return "/images/courses/" . $this->picture;
	}
	public function getRouteKeyName()
	{
		return 'slug';
	}

	//Seccion 6 - 20: establecer las relaciones en ORM Elocuent
	//definiremos un metodo en el modelo. categorias relacionadas con el curso 
	public function category(){
		//Category pertenece a Course
		return $this->belongsTo(Category::class)->select( 'id', 'name');
	}
	public function goals(){
		//uno es a mucho hasMany, retomamos los registros categoria tiene muchas metas, es importante siempre llamar las FK
		return $this->hasMany(Goal::class)->select('id', 'course_id', 'goal');
	}
	public function level (){
		//level pertenece a un curso
		return $this->belongsTo(Level::class)->select('id', 'name');
	}
	public function reviews(){
		return $this->hasMany(Review::class)->select('id', 'course_id', 'user_id', 'rating', 'created_at');
	}
	public function requirements(){
		return $this->hasMany(Requirement::class)->select('id', 'course_id', 'requirement');
	}
	public function students(){
		//Relacion de muchos es a muchos
		return $this->belongsToMany(Student::class);
	}
	public function teacher(){
		//un profresor pertenece a un curso
		return $this->belongsTo(Teacher::class);
	}
	//rating
    public function getRatingAttribute(){
	    return $this->reviews()->avg('rating');
	}
	public function relatedCourses(){
		return Course::with('reviews')->whereCategoryId($this->category->id)
		->where('id', '!=', $this->id)
		->latest()
		->limit(6)
		->get();
	}
}
