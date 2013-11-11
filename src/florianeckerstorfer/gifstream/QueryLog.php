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
 * QueryLog
 *
 * @package   florianeckerstorfer/gifstream
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2013 Florian Eckerstorfer
 * @link      http://gifstream.florian.ec
 */
class QueryLog
{
    /** @var string */
    private $logFile;

    /**
     * @param string $logFile
     */
    public function __construct($logFile)
    {
        $this->logFile = $logFile;
    }

    /**
     * Writes the query to the log file.
     *
     * @param string $query
     *
     * @return void
     */
    public function log($query)
    {
        $data = array(
            date('Y-m-d H:i:s'),
            $query,
            addslashes(strip_tags($_SERVER['HTTP_USER_AGENT'])),
            strip_tags($_SERVER['REMOTE_ADDR'])
        );
        $data = implode(',', array_map(
            function ($x) { return sprintf('"%s"', $x); },
            $data
        ));
        file_put_contents($this->logFile, $data."\n", FILE_APPEND);
    }
}
