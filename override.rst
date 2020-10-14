Override Default Entities
=========================

This example shows how to override default entities.
The same procedure is used any time default entities will be overridden.

First you'll need a new module for the modified xml.  Call it ``OAuth2``.  Next copy
the ``apiskeletons-oauth2-doctrine/config/orm/*.xml`` into your new
module ``OAuth2/config/orm`` (create this directory).

Edit the xml as needed.  Next edit your
`oauth2.doctrine-orm.global.php` file and set `'enable_default_entities' => false`
You may need to modify the config file to match the new xml.

Now in OAuth2/config/module.config.php add the Doctrine config and alias the xml::

    'doctrine' => array(
        'driver' => array(
            'oauth2_driver' => array(
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\XmlDriver',
                'paths' => array(
                    0 => __DIR__ . '/orm',
                ),
            ),
            'orm_default' => array(
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\DriverChain',
                'drivers' => array(
                    'ApiSkeletons\\OAuth2\\Doctrine\\Entity' => 'oauth2_driver',
                ),
            ),
        ),
    ),

.. include:: footer.rst

.. raw:: html
    :file: analytics.html
