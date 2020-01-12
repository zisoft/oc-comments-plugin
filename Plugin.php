<?php namespace Zisoft\Comments;

use Backend;
use System\Classes\PluginBase;
use Lang;

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
            'name'        => Lang::get('zisoft.comments::lang.plugin.name'),
            'description' => Lang::get('zisoft.comments::lang.plugin.description'),
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

    /**
     * Registers any mail templates implemented in this plugin.
     *
     * @return array
     */
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
        return [
            'comments' => [
                'label'       => Lang::get('zisoft.comments::lang.plugin.name'),
                'url'         => Backend::url('zisoft/comments/comments'),
                'icon'        => 'icon-comments-o',
                'permissions' => ['zisoft.comments.*'],
                'order'       => 500,
            ],
        ];
    }
}
