Module Configuration
====================


Using Default Entities
----------------------

Details for creating your database with the included entities are outside the
scope of this project.  Generally this is done through
`doctrine/doctrine-orm-module <https://github.com/doctrine/DoctrineORMModule>`_
with ``php public/index.php orm:schema-tool:create``

By default this module uses the entities provided but you may use the adapter with your own entites
(and map them in the mapping config section) by toggling this flag::

    'apiskeletons-oauth2-doctrine' => [
        'default' => [
            'enable_default_entities' => true,


Customizing Many to One Mapping
-------------------------------

If you need to customize the call to mapManyToOne, which creates the dynamic joins to the User
entity from the default entites, you may add any parameters to the
``['dynamic_mapping']['default_entity']['additional_mapping_data']`` element.  An example for a
User entity with a primary key of user_id which does not conform to the metadata naming strategy
is added to each entity::

    'refresh_token_entity' => [
        'entity' => 'ZF\OAuth2\Doctrine\Entity\RefreshToken',
        'field' => 'refreshToken',
        'additional_mapping_data' => [
            'joinColumns' => [
                [
                    'name' => 'user_id',
                    'referencedColumnName' => 'user_id',
                ],
            ],
        ],
    ],


Identity field on User entity
-----------------------------

By default this Doctrine adapter retrieves the user by the `username` field on
the configured User entity. If you need to use a different or multiple fields
you may do so via the ``auth_identity_fields`` key. For example
authenticate by username or email fields.

An example to match ZfcUser ``auth_identity_fields`` configuration::

    'zf-oauth2-doctrine' => [
        'default' => [
            'auth_identity_fields' => ['username', 'email'],

.. include:: footer.rst

.. raw:: html
    :file: analytics.html
