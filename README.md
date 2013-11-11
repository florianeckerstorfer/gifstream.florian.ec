Tumblr GifStreams
=================

Create [GifStream](http://gifstream.in)s based on Tumblr tags. It runs on [http://gifstream.florian.ec](http://gifstream.florian.ec).

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

If you want to modify the layout, you probably want to run [Compass](http://gifstream.in/s/http://gifstream.florian.ec/game+of+thrones.json):

    $ compass compile web/

Or you can make Compass watch for changes:

    $ compass watch web/


License
-------

gifstream.florian.ec is licensed under The MIT License. See the LICENSE file in the projects root directory for more information.
