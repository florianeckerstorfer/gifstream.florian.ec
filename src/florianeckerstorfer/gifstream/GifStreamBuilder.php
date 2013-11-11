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
 * GifStreamBuilder
 *
 * @package   florianeckerstorfer/gifstream
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2013 Florian Eckerstorfer
 * @link      http://gifstream.florian.ec
 */
class GifStreamBuilder implements \Countable
{
    /** @var array */
    private $gifs = array();

    /**
     * Add a GIF to the stream.
     *
     * @param array $gif
     *
     * @return GifStreamBuilder
     */
    public function add(array $gif)
    {
        $this->gifs[] = $gif;

        return $this;
    }

    /**
     * @return integer Number of GIFs
     */
    public function count()
    {
        return count($this->gifs);
    }

    /**
     * Returns an array of the GifStream.
     *
     * @param string $query Query term
     * @return array Gif stream
     */
    public function build($query)
    {
        return array(
            'version'    => 1,
            'title'      => sprintf('Tumblr Tag "%s"', $query),
            'identifier' => sprintf('ec.florian.gifstream.%s', str_replace(' ', '-', strtolower($query))),
            'license'    => '',
            'files'      => $this->gifs
        );
    }
}
