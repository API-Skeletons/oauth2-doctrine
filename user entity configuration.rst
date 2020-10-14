User Entity Configuration
=========================


This repository supplies every entity you need to implement OAuth2
except the User entity.  The reason is so the User entity can be
decoupled from the OAuth2 Doctrine repository instead to be linked
dynamically at run time.  This allows, among other benefits, the ability
to create an ERD without modifying the `OAuth2-orm.module.xml` module.

The User entity must implement
``ApiSkeletons\OAuth2\Doctrine\Entity\UserInterface``

The User entity for the unit test for this module is a good template to start from:
`https://github.com/API-Skeletons/oauth2-doctrine/blob/master/test/asset/module/Testing/src/Entity/User.php <https://github.com/API-Skeletons/oauth2-doctrine/blob/master/test/asset/module/Testing/src/Entity/User.php>`_

.. include:: footer.rst

.. raw:: html
    :file: analytics.html
