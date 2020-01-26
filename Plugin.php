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
        return [
            'zisoft.comments.manage_comments' => [
                'tab' => 'comments',
                'label' => Lang::get('zisoft.comments::lang.backend.permissions.label'),
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

    /**
     * Registers back-end settings for this plugin.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => Lang::get('zisoft.comments::lang.settings.label'),
                'description' => Lang::get('zisoft.comments::lang.settings.description'),
                'category'    => Lang::get('zisoft.comments::lang.settings.category'),
                'icon'        => 'icon-comments-o',
                'class'       => 'Zisoft\Comments\Models\Settings',
                'order'       => 500
            ]
        ];
    }


    /**
     * Registers back-end report widgets for this plugin.
     *
     * @return array
     */
    public function registerReportWidgets()
    {
        return [
            'Zisoft\Comments\ReportWidgets\CommentsStatistics' => [
                'label'   => Lang::get('zisoft.comments::lang.reportwidgets.label'),
                'context' => 'dashboard',
                'permissions' => ['zisoft.comments.*']
            ]
        ];
    }
}
