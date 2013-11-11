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
use florianeckerstorfer\gifstream\GifStreamBuilder;

/**
 * GifStreamBuilderServiceProvider
 *
 * @package    florianeckerstorfer/gifstream
 * @subpackage Provider
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @link       http://gifstream.florian.ec
 */
class GifStreamBuilderServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Application $app)
    {
        $app['gifstreambuilder'] = $app->share(function ($app) {
            return new GifStreamBuilder;
        });
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $app)
    {
    }
}
