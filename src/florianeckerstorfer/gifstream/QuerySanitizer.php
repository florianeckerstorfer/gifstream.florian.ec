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
 * QuerySanitizer
 *
 * @package   florianeckerstorfer/gifstream
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2013 Florian Eckerstorfer
 * @link      http://gifstream.florian.ec
 */
class QuerySanitizer
{
    /**
     * @param string $query
     *
     * @return string
     */
    public function sanitize($query)
    {
        return strtolower(urldecode(trim(strip_tags($query))));
    }
}
