Entity Relationship Diagram
===========================

.. image:: https://raw.githubusercontent.com/API-Skeletons/oauth2-doctrine/master/media/oauth2-doctrine-erd.png

Entity Relationship Diagram created with `Skipper <https://skipper18.com>`_

The Skipper module is located at
`media/OAuth2-orm.module.xml <https://github.com/API-Skeletons/oauth2-doctrine/blob/master/media/OAuth2-orm.module.xml>`_
and is intended to be embedded in the Skipper ERD for your project.


Relations
---------

The User entity is provided by your application and a dynamic join is made at
runtime when the metadata is gathered for Doctrine.  There is a dynamic join
with Client, AuthorizationCode, AccessToken and RefreshToken.

The central OAuth2 entity is the Client.  There is a dynamic join from the
Client entity to the configured User entity.  For every application owned by a
User there will be a Client entry.  The User referenced from a Client is the
User who owns that Client.

The AuthorizationCode entity is used when a User connects from an application
using OAuth2.  The reference to the User entity from the AuthorizationCode
entity is for the User that is trying to log into the Client referenced from
the AuthorizationCode entity.  The same is true for the AccessToken and
RefreshToken entities.

The Scope entities are many to many relationships for Client,
AuthorizationCode, AccessToken and RefreshToken.  Scopes dictate what
permissions a Client has into the API.  The Scope entity is a fixture.

There is a one to one relationship from Client to PublicKey.  This is because
the encryption side of OAuth2 is less common and to encapsulate the encryption
fields into the PublicKey entity.  The JWT and JTI entities provide full
support and their use in encryption falls outside the scope of this
documentation.


Database Table Namespaces
-------------------------

All OAuth2 tables are suffixed with _OAuth2 such as Client_OAuth2.  You can
change these if you :ref:`override`.  It is recommended your database table
names match your entity names to provide canonical naming across your
application.  See also `bushbaby/zf-oauth2-doctrine-mutatetablenames <https://github.com/basz/zf-oauth2-doctrine-mutatetablenames>`_.

.. include:: footer.rst

.. raw:: html
    :file: analytics.html
