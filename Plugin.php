<?php namespace Zisoft\Comments;

use Backend;
use System\Classes\PluginBase;

/**
 * comments Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Comments',
            'description' => 'Allow users to add comments to pages',
            'author'      => 'Mario Zimmermann',
            'icon'        => 'icon-comments-o'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Zisoft\Comments\Components\Comments' => 'comments',
            'Zisoft\Comments\Components\CommentCount' => 'commentcount',
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'zisoft.comments::mail.new_comment'
        ];
    }    

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'zisoft.comments.some_permission' => [
                'tab' => 'comments',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'comments' => [
                'label'       => 'comments',
                'url'         => Backend::url('zisoft/comments/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['zisoft.comments.*'],
                'order'       => 500,
            ],
        ];
    }
}
