<?php

/**
 * This file is part of florianeckerstorfer/gifstream.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Symfony\Component\HttpFoundation\Request;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use florianeckerstorfer\gifstream\Provider\TumblrServiceProvider;
use florianeckerstorfer\gifstream\Provider\GifSearchServiceProvider;
use florianeckerstorfer\gifstream\Provider\GifStreamBuilderServiceProvider;
use florianeckerstorfer\gifstream\Provider\GifStreamCacheServiceProvider;

$app = new Silex\Application();

if (true === $debug || '.dev' === substr($_SERVER['HTTP_HOST'], -4)) {
    $app['debug'] = true;
}

$app->register(new TwigServiceProvider, array(
    'twig.path' => sprintf('%s/views', APP_ROOT),
));
$app->register(new UrlGeneratorServiceProvider);
$app->register(new TumblrServiceProvider, array(
    'tumblr.options' => $config['tumblr']
));
$app->register(new GifSearchServiceProvider);
$app->register(new GifStreamBuilderServiceProvider);
$app->register(new GifStreamCacheServiceProvider, array(
    'gifstreamcache.cache_dir' => APP_ROOT.'/cache',
    'gifstreamcache.cache_time' => 43200
));

$app->get('/{query}.json', function ($query) use($app) {
    if ($query) {
        $query = urldecode($query);
        $gifStreamCache = $app['gifstreamcache'];

        if (true === $gifStreamCache->has($query)) {
            $result = $gifStreamCache->get($query);
        } else {
            $app['gifsearch']->search($query);
            $result = $app['gifstreambuilder']->build($query);
            $gifStreamCache->put($query, $result);
        }

        return $app->json($result);
    }

    $error = array('message' => 'No query term given.');
    return $app->json($error, 400);
})->bind('gifstream');

$app->get('/', function(Request $request) use($app) {
    return $app['twig']->render('index.html.twig', array(
        'query' => $request->get('query')
    ));
})->bind('index');

$app->run();
