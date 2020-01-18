<?php namespace Zisoft\Comments\Models;

use Model;

/**
 * comment Model
 */
class Comment extends Model
{
    use \October\Rain\Database\Traits\SimpleTree;
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'zisoft_comments_comments';

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */ 
    public $timestamps = false;

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = ['dt'];


    /**
     * @var array Validation rules
     */
    public $rules = [
        'name'  => 'required',
        'email' => 'required|email',
        'text'  => 'required'
    ];



    /**
     * Scope a query to only include pending comments.
     */
    public function scopePending($query)
    {
        return $query->where('is_pending', 1);
    }

}
