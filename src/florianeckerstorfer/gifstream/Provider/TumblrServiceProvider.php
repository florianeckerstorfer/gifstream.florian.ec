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
use Tumblr\API\Client as TumblrClient;

/**
 * TumblrServiceProvider
 *
 * @package    florianeckerstorfer/gifstream
 * @subpackage Provider
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @link       http://gifstream.florian.ec
 */
class TumblrServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Application $app)
    {
        $app['tumblr.options'] = array();
        $app['tumblr'] = $app->share(function ($app) {
            $consumerKey    = $app['tumblr.options']['consumer_key'];
            $consumerSecret = $app['tumblr.options']['consumer_secret'];

            return new TumblrClient($consumerKey, $consumerSecret);
        });
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $app)
    {
    }
}
