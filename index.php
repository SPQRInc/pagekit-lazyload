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
        'combined'        => false,
        'delay'           => -1,
        'callback'        => [
            'enabled'       => false,
            'beforeload'    => '',
            'afterload'     => '',
            'onerror'       => '',
            'onfinishedall' => '',
        ],
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
                    $options[] = "effect: '$effect'";
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
                    $options[] = "scrollDirection: '$scrolldirection'";
                }
                
                if ($combined = (array_key_exists('combined', $config)
                    ? $config['combined'] : false)
                ) {
                    $options[] = "combined: $combined";
                }
                
                if ($delay = (array_key_exists('delay', $config)
                    ? $config['delay'] : -1)
                ) {
                    $options[] = "delay: $delay";
                }
                
                if ($enablecallback = (array_key_exists('enabled',
                    $config['callback']) ? $config['callback']['enabled']
                    : false)
                ) {
                    
                    if ($beforeload = (array_key_exists('beforeload',
                        $config['callback']) ? $config['callback']['beforeload']
                        : false)
                    ) {
                        if (!empty($beforeload)) {
                            $options[]
                                = "beforeLoad: function(element){ $beforeload }";
                        }
                    }
                    
                    if ($afterload = (array_key_exists('afterload',
                        $config['callback']) ? $config['callback']['afterload']
                        : false)
                    ) {
                        if (!empty($afterload)) {
                            $options[]
                                = "afterLoad: function(element){ $afterload }";
                        }
                    }
                    
                    if ($onerror = (array_key_exists('onerror',
                        $config['callback']) ? $config['callback']['onerror']
                        : false)
                    ) {
                        if (!empty($onerror)) {
                            $options[]
                                = "onError: function(element){ $onerror }";
                        }
                    }
    
    
                    if ($onfinishedall = (array_key_exists('onfinishedall',
                        $config['callback']) ? $config['callback']['onfinishedall']
                        : false)
                    ) {
                        if (!empty($onfinishedall)) {
                            $options[]
                                = "onFinishedAll: function(){ $onfinishedall }";
                        }
                    }
                    
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
                ['~extensions', 'editor']);
        },
    ],
];