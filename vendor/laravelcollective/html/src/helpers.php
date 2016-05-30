<?php

if (!function_exists('link_to')) {
    /**
     * Generate a HTML link.
     *
     * @param string $url
     * @param string $title
     * @param array  $attributes
     * @param bool   $secure
     *
     * @return string
     */
    function link_to($url, $title = null, $attributes = [], $secure = null)
    {
        return app('html')->link($url, $title, $attributes, $secure);
    }
}

if (!function_exists('link_to_asset')) {
    /**
     * Generate a HTML link to an asset.
     *
     * @param string $url
     * @param string $title
     * @param array  $attributes
     * @param bool   $secure
     *
     * @return string
     */
    function link_to_asset($url, $title = null, $attributes = [], $secure = null)
    {
        return app('html')->linkAsset($url, $title, $attributes, $secure);
    }
}

if (!function_exists('link_to_route')) {
    /**
     * Generate a HTML link to a named route.
     *
     * @param string $name
     * @param string $title
     * @param array  $parameters
     * @param array  $attributes
     *
     * @return string
     */
    function link_to_route($name, $title = null, $parameters = [], $attributes = [])
    {
        return app('html')->linkRoute($name, $title, $parameters, $attributes);
    }
}

if (!function_exists('link_to_action')) {
    /**
     * Generate a HTML link to a controller action.
     *
     * @param string $action
     * @param string $title
     * @param array  $parameters
     * @param array  $attributes
     *
     * @return string
     */
    function link_to_action($action, $title = null, $parameters = [], $attributes = [])
    {
        return app('html')->linkAction($action, $title, $parameters, $attributes);
    }
}

if (! function_exists('FNumber')) {
    /**
     * Conver digit Number from en to fa
     *
     * @param string $Number
     *
     * @return string
     */
    function FNumber($Number)
    {
        $Number_list = ["0" => "۰", "1" => "۱", "2" => "۲", "3" => "۳", "4" => "۴", "5" => "۵", "6" => "۶", "7" => "۷", "8" => "۸", "9" => "۹"];

        return str_replace(array_flip($Number_list) ,$Number_list, $Number);
    }
}

if (! function_exists('makeTree')) {
    /**
     * Conver digit Number from en to fa
     *
     * @param string $Number
     *
     * @return string
     */
    function makeTree($makeTree)
    {
        echo '<ul>';
            foreach ( $makeTree as $item ) {
                echo '<li id="'.$item['xlayerid'].'"> '.$item['xlayer_title'];
                if ( isset( $item['children'] ) ) {
                    makeTree( $item['children'] );
                }
            }
        echo '</li></ul>';
    }
}

if (!function_exists("pArrayTojArray")){
    function pArrayTojArray($siteAna){
        $list = "[";
        foreach ($siteAna as $key => $value) {
            $list .="['". $value['xlayer_title'] ."','". $value['xcount'] ."'],"; 
        }
        $list .= "]";
        return $list;
    }
}

