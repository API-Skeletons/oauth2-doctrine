Add-Ons
=======

`api-skeletons/oauth2-doctrine-console <https://github.com/API-Skeletons/oauth2-doctrine-console>`_
--------------------

Console routes to manage OAuth2 entities.  Add and list Clients, Scopes, and
more from the command line.


`api-skeletons/oauth2-doctrine-identity <https://github.com/API-Skeletons/oauth2-doctrine-identity>`_
--------------------

This should have been a part of zf-oauth2-doctrine from the beginning but
because zf-oauth2-doctrine is so mature identity mapping has been implemented
in this add-on repository.  This will change the AuthenticatedIdentity of
`laminas-api-tools/api-tools-mvc-auth <https://github.com/laminas-api-tools/api-tools-mvc-auth>`_
to a Doctrine enabled identity with quick access to the User, Client, and
AccessToken entities.

`api-skeletons/oauth2-doctrine-permissions-acl <https://github.com/API-Skeletons/oauth2-doctrine-permissions-acl>`_
----------------------

ACL Permissions and Authenticated Identity management.  This uses interfaces
rather than defining entities to create guards on resources based on
`api-skeletons/oauth2-doctrine-identity <https://github.com/API-Skeletons/oauth2-doctrine-identity>`_

.. include:: footer.rst

.. raw:: html
    :file: analytics.html
