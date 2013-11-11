<?php

/**
 * This file is part of florianeckerstorfer/gifstream.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace florianeckerstorfer\gifstream;

/**
 * GifStreamCache
 *
 * @package   florianeckerstorfer/gifstream
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2013 Florian Eckerstorfer
 * @link      http://gifstream.florian.ec
 */
class GifStreamCache
{
    /** @var string */
    private $cacheDir;

    /** @var integer */
    private $cacheTime;

    /**
     * @param string $cacheDir
     */
    public function __construct($cacheDir, $cacheTime)
    {
        $this->cacheDir = $cacheDir;
        $this->cacheTime = $cacheTime;
    }

    /**
     * @param string $query
     *
     * @return boolean
     */
    public function has($query)
    {
        $file = $this->getCacheFile($query);

        return file_exists($file) && (filemtime($file) + $this->cacheTime) > time();
    }

    /**
     * @param string $query
     *
     * @return array
     */
    public function get($query)
    {
        return unserialize(file_get_contents($this->getCacheFile($query)));
    }

    /**
     * @param string $query
     * @param array  $content
     *
     * @return GifStreamCache
     */
    public function put($query, $content)
    {
        file_put_contents($this->getCacheFile($query), serialize($content));

        return $this;
    }

    /**
     * @param string $query
     *
     * @return string
     */
    protected function getCacheFile($query)
    {
        return sprintf('%s/%s.json', $this->cacheDir, urlencode(strtolower($query)));
    }
}
