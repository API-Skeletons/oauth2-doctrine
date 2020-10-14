api-tools-doctrine Integration
=================================

Validate api-tools-doctrine resources
----------------------------------------

To validate the OAuth2 session with Query Create Filters and Query Providers
implement ``ApiSkeletons\OAuth2\Doctrine\OAuth2ServerInterface`` and
use ``ApiSkeletons\OAuth2\Doctrine\OAuth2ServerTrait``.
Then call ``$result = $this->validateOAuth2($scope);`` in the filter function.

.. include:: footer.rst

.. raw:: html
    :file: analytics.html
