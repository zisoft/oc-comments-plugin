<?php namespace Zisoft\Comments\Models;

use Model;

/**
 * settings Model
 */
class Settings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'zisoft_comments_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'approval_email' => 'email',
        'quickreply_email' => 'email'
    ];    
}
