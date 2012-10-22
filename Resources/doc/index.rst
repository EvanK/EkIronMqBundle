CodeMeme\IronMqBundle
=====================

About
-----

This bundle is a wrapper around the `IronMQ PHP bindings`_, and simply
configures and exposes an ``IronMQ`` instance through the service container.

Installation with Composer
--------------------------

Add a dependency to your `composer.json` file:

.. code-block :: js

    // composer.json
    {
        // ...
        require: {
            // ...
            "codememe/ironmq-bundle": "dev-master"
        }
    }

Run Composer's ``update`` command from the directory where your
``composer.json`` file is located:

.. code-block :: bash

    $ php composer.phar update

Update your ``AppKernel.php`` to register the bundle:

.. code-block :: php

    <?php

    // in AppKernel::registerBundles()
    $bundles = array(
        // ...
        new CodeMeme\IronMqBundle\CodeMemeIronMqBundle(),
        // ...
    );

Configuration
-------------

Following are the supported configuration params, all of which aside from
``enabled`` are passed through to the underlying `IronMQ PHP bindings`_.
Required parameters are uncommented below:

.. code-block :: yml

    # app/config/config.yml

    code_meme_iron_mq:
        enabled: true # if set to false, service will not be available
        token: "abc123def456"
        project_id: "zyx987wvu654"
    #    api:
    #        protocol: https
    #        host: mq-aws-us-east-1.iron.io
    #        port: 443
    #        api_version: 1
    #    options:
    #        max_retries: 5
    #        debug_enabled: false
    #        ssl_verifypeer: true
    #        connection_timeout: 60

Usage
-----

From your application, you can retrieve an instantiated ``IronMQ`` instance
directly from Symfony's service container:

.. code-block :: php

    <?php

    $ironmq = $container->get('code_meme_iron_mq.messagequeue');
    $ironmq->postMessage('queue_name', 'some message!');

License
-------

This code is released under the permissive `MIT License`_.

.. _IronMQ PHP bindings: https://github.com/iron-io/iron_mq_php
.. _MIT license: http://en.wikipedia.org/wiki/MIT_License
