<?php

namespace Omaicode\Admin\Media;

use Omaicode\Admin\Admin;

trait BootExtension
{
    /**
     * {@inheritdoc}
     */
    public static function boot()
    {
        static::registerRoutes();

        Admin::extend('media-manager', __CLASS__);
    }

    /**
     * Register routes for laravel-admin.
     *
     * @return void
     */
    protected static function registerRoutes()
    {
        parent::routes(function ($router) {
            /* @var \Illuminate\Routing\Router $router */
            $router->get('media', 'Omaicode\Admin\Media\MediaController@index')->name('media-index');
            $router->get('media/download', 'Omaicode\Admin\Media\MediaController@download')->name('media-download');
            $router->delete('media/delete', 'Omaicode\Admin\Media\MediaController@delete')->name('media-delete');
            $router->put('media/move', 'Omaicode\Admin\Media\MediaController@move')->name('media-move');
            $router->post('media/upload', 'Omaicode\Admin\Media\MediaController@upload')->name('media-upload');
            $router->post('media/folder', 'Omaicode\Admin\Media\MediaController@newFolder')->name('media-new-folder');
        });
    }

    /**
     * {@inheritdoc}
     */
    public static function import()
    {
        parent::createMenu('Media manager', 'media', 'fa-file');

        parent::createPermission('Media manager', 'ext.media-manager', 'media*');
    }
}
