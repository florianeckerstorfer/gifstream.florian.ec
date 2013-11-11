Tumblr GifStreams
=================

Author
------

- [Florian Eckerstorfer](http://florian.ec) ([Twitter](http://twitter.com/Florian_), [App.net](http://app.net/florian))

Installation
------------

Clone repository from Github:

    $ git clone https://github.com/florianeckerstorfer/tumblr-gifstream
    $ cd tumblr-gifstream

Install [Composer](http://getcomposer.org) and download dependencies:

    $ curl -sS https://getcomposer.org/installer | php
    $ php composer.phar update

Create and edit configuration:

    $ cp config/config.php.dist config.php
    $ vi config/config.php

Create a cache directory and fix permissions:

    $ mkdir cache
    $ chmod -R 777 cache/
