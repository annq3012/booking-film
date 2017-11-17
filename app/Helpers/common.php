<?php

use App\Model\Cinema;
use App\Model\City;
use App\Model\Film;
use App\Model\User;

if (!function_exists('isActiveRoute')) {
    
    /**
     * Active menu side bar when route menu is current route
     *
     * @param string $route  route of page
     * @param string $output active or ''
     *
     * @return string
     */
    function isActiveRoute($route, $output = "active")
    {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }
}

if (!function_exists('areActiveRoute')) {

    /**
     * Active menu side bar when routes menu are current route
     *
     * @param Array  $routes routes action
     * @param string $output active or ''
     *
     * @return string
     */
    function areActiveRoute(array $routes, $output = "active")
    {
        if (in_array(Route::currentRouteName(), $routes, true)) {
            return $output;
        }
    }
}

if (!function_exists('getCount')) {
    
    /**
     * Get percent progress name of database
     *
     * @param string $name name of database
     *
     * @return float
     */
    function getCount($name)
    {
        $count = array('users' => User::count() , 'films' => Film::count(),
        'cinemas' => Cinema::count(),
        'cities' => City::count());
        return $count[$name];
    }
}
