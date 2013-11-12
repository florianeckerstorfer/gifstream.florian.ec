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

use Tumblr\API\Client as TumblrClient;

/**
 * GifSearch
 *
 * @package   florianeckerstorfer/gifstream
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2013 Florian Eckerstorfer
 * @link      http://gifstream.florian.ec
 */
class GifSearch
{
    /** @var TumblrClient */
    private $tumblr;

    /**
     * @param TumblrClient     $tumblr
     * @param GifStreamBuilder $builder
     */
    public function __construct(TumblrClient $tumblr, GifStreamBuilder $builder)
    {
        $this->tumblr = $tumblr;
        $this->builder = $builder;
    }

    /**
     * Searches Tumblr for the given tag and returns up to 200 GIFs.
     *
     * @param string $tag Tag to search for
     *
     * @return array
     */
    public function search($tag)
    {
        $counter = 0;
        $before = null;
        do {
            $before = $this->searchPage($tag, $before);
            $counter += 1;
            if (false === $before) {
                return;
            }
        } while (count($this->builder) < 100 || $counter > 10);
    }

    /**
     * Executes a single API request and returns the time of the last posting.
     *
     * @param string  $tag    Tag to search for
     * @param integer $before Unix timestamp
     *
     * @return array
     */
    protected function searchPage($tag, $before = null)
    {
        $posts = $this->tumblr->getTaggedPosts($tag, array(
            'limit' => 20,
            'before' => $before ? $before : time()
        ));

        foreach ($posts as $post) {
            if ('photo' !== $post->type) {
                continue;
            }
            foreach ($post->photos as $photo) {
                if (false === isset($photo->alt_sizes[0]->url)) {
                    continue;
                }
                $url = $photo->alt_sizes[0]->url;
                if (1 !== preg_match('/\.gif$/', $url)) {
                    continue;
                }
                $date = new \DateTime($post->date);

                $this->builder->add(array(
                    'title' => trim(strip_tags($post->caption)),
                    'added' => $date->getTimestamp(),
                    'src'  => $url
                ));
            }
        }

        $before = false;
        if (true === isset($post->date)) {
            $date = new \DateTime($post->date);
            $before = $date->getTimestamp();
        }

        return $before;
    }
}
