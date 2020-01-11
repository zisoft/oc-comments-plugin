<?php namespace Zisoft\Comments\Models;

use Model;

/**
 * comment Model
 */
class Comment extends Model
{
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

    protected $dates = ['dt'];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

}
