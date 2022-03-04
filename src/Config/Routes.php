<?php

/*
 * CMS routes file.
 */
$routes->group('cms', ['namespace' => 'Colabs\Cms\Controllers'], function ($routes) {
    $routes->get('content/(:segment)', 'Content::$1');
    $routes->get('kategori/(:segment)', 'Kategori::$1');
    $routes->get('menu/(:segment)', 'Menu::$1');
    $routes->get('setting/(:segment)', 'Setting::$1');
});