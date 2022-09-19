<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

if(!function_exists('active')):
    function active($routeNames){
        $class = "";
        if(is_array($routeNames)):
            foreach($routeNames as $routeName):
               if(setActive($routeName)):
                    $class = "menu-item-active active";
                    break;
               endif;
            endforeach;
        else:
            if(setActive($routeNames)):
                $class = "menu-item-active active";
            endif;
        endif;
       return $class;
    }
endif;
if(!function_exists('setActive')):
    function setActive($routeName){
        return request()->routeIs($routeName);
    }
endif;
if(!function_exists('formatBytes')):
    function formatBytes($size, $precision = 2){
        $base = log($size, 1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');
        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }
endif;
if(!function_exists('imageManager')):
    function imageManager($url, $width, $model){
        $imageOptimized = ImageManagerStatic::make(Storage::get($url))->widen($width)->encode('webp');
        $urlEncode = $url.'.webp';
        Storage::put($url, (string) $imageOptimized);
        Storage::move($url, $urlEncode);
        if($model->image):
            if(Storage::exists($model->image->url)):
                Storage::delete($model->image->url);
            endif;
            $model->image()->update([
                'url' => $urlEncode,
            ]);
        else:
            $model->image()->create([
                'url' => $urlEncode,
                'main' => true,
            ]);
        endif;
    }
endif;
if(!function_exists('imagesManager')):
    function imagesManager($url, $width, $model){
        $imageOptimized = ImageManagerStatic::make(Storage::get($url))->widen($width)->encode('webp');
        $urlEncode = $url.'.webp';
        Storage::put($url, (string) $imageOptimized);
        Storage::move($url, $urlEncode);
        $model->images()->create([
            'url' => $urlEncode
        ]);
    }
endif;
if(!function_exists('sectionMenuIsVisible')):
    function sectionMenuIsVisible($section){
        $response = false;
        foreach($section['modules'] as $module):
            if($module['urlName']):
                if(Route::has($module['urlName'])):
                    $response = true;
                endif;
            else:
                foreach($module['submodules'] as $submodule):
                    if($submodule['urlName']):
                        if(Route::has($submodule['urlName'])):
                            $response = true;
                        endif;
                    endif;
                endforeach;
            endif;
        endforeach;
        return $response;
    }
endif;

