<?php

use Pagekit\Application as App;
use Spqr\Lazyload\Plugin\LazyloadPlugin;


return [
    'name' => 'spqr/lazyload',
    'type' => 'extension',
    'main' => function ($app) {
    
    },
    
    'autoload' => [
        'Spqr\\Lazyload\\' => 'src',
    ],
    
    'routes' => [],
    
    'widgets' => [],
    
    'menu' => [],
    
    'permissions' => [],
    
    'settings' => 'lazyload-settings',
    
    'resources' => [
        'spqr/lazyload:' => '',
    ],
    
    'config' => [
        'class'           => 'lazy',
        'effect'          => 'show',
        'effecttime'      => 2000,
        'threshold'       => 0,
        'visibleonly'     => true,
        'scrolldirection' => 'both',
    ],
    
    'events' => [
        'boot'         => function ($event, $app) {
            $app->subscribe(new LazyloadPlugin);
        },
        'site'         => function ($event, $app) {
            $app->on('view.content', function ($event, $scripts) use ($app) {
                
                $module  = App::module('spqr/lazyload');
                $config  = $module->config;
                $options = [];
                $class   = $config['class'];
                
                if ($effect = (array_key_exists('effect', $config)
                    ? $config['effect'] : 'show')
                ) {
                    $options[] = "effect: '$effect''";
                }
                
                if ($effecttime = (array_key_exists('effecttime', $config)
                    ? $config['effecttime'] : 0)
                ) {
                    $options[] = "effectTime: $effecttime";
                }
                
                if ($threshold = (array_key_exists('threshold', $config)
                    ? $config['threshold'] : 0)
                ) {
                    $options[] = "threshold: $threshold";
                }
                
                if ($visibleonly = (array_key_exists('visibleonly', $config)
                    ? $config['visibleonly'] : false)
                ) {
                    $options[] = "visibleOnly: $visibleonly";
                }
                
                if ($scrolldirection = (array_key_exists('scrolldirection',
                    $config) ? $config['scrolldirection'] : 'both')
                ) {
                    $options[] = "scrollDirection: '$scrolldirection''";
                }
                
                $options = implode(",", $options);
                
                $script
                    = "$(function($) {
                               $('img.$class').Lazy({
                                    $options
                                });
                           });";
                
                $app['scripts']->add('lazy-load',
                    'spqr/lazyload:app/assets/jquery-lazy/jquery.lazy.js',
                    ['jquery']);
                
                $app['scripts']->add('spqr/lazyload', $script, [], 'string');
                
            });
        },
        'view.scripts' => function ($event, $scripts) use ($app) {
            $scripts->register('lazyload-settings',
                'spqr/lazyload:app/bundle/lazyload-settings.js',
                ['~extensions']);
        },
    ],
];