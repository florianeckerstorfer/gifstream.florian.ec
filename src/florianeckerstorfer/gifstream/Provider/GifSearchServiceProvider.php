<?php

/**
 * This file is part of florianeckerstorfer/gifstream.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace florianeckerstorfer\gifstream\Provider;

use Silex\ServiceProviderInterface;
use Silex\Application;
use florianeckerstorfer\gifstream\GifSearch;

/**
 * GifSearchServiceProvider
 *
 * @package    florianeckerstorfer/gifstream
 * @subpackage Provider
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @link       http://gifstream.florian.ec
 */
class GifSearchServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Application $app)
    {
        $app['gifsearch'] = $app->share(function ($app) {
            return new GifSearch($app['tumblr'], $app['gifstreambuilder']);
        });
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $app)
    {
    }
}
