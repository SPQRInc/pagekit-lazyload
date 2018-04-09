<?php

namespace Spqr\Lazyload\Plugin;

use Pagekit\Application as App;
use Pagekit\Content\Event\ContentEvent;
use Pagekit\Event\EventSubscriberInterface;
use Sunra\PhpSimple\HtmlDomParser;


class LazyloadPlugin implements EventSubscriberInterface
{
    /**
     * Content plugins callback.
     *
     * @param ContentEvent $event
     */
    public function onContentPlugins(ContentEvent $event)
    {
        $content  = $event->getContent();
        $config   = App::module('spqr/lazyload')->config();
        $selector = 'img.'.$config['class'];
        
        if ($content) {
            $dom = HtmlDomParser::str_get_html($content, true, true,
                DEFAULT_TARGET_CHARSET, false, DEFAULT_BR_TEXT,
                DEFAULT_SPAN_TEXT);
            
            foreach ($dom->find($selector) as $img) {
                $src = $img->getAttribute('src');
                
                if ($src && !empty($src)) {
                    $img->removeAttribute('src');
                    $img->setAttribute('data-src', $src);
                }
                
            }
            
            $content = $dom->save();
            $event->setContent($content);
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function subscribe()
    {
        return [
            'content.plugins' => ['onContentPlugins', 10],
        ];
    }
    
}