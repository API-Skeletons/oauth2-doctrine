Events
======


Events are fully supported.  Return values are used if propagation is stopped
allowing you to write your own handlers for any OAuth2 Adapter method.  Each
function which implements the OAuth2 interfaces may be attached to and
optionally overridden.


Example Event Attachment
------------------------

*Module.php onBootstrap*::

    $doctrineOAuth2Adapter = $e->getParam('application')
        ->getServiceManager()
        ->get('oauth2.doctrineadapter.default')
         ;
    $listenerAggregate = new \Application\EventSubscriber\OAuth2AggregateListener($objectManager);
    $doctrineOAuth2Adapter->getEventManager()->attachAggregate($listenerAggregate);


*Application\EventSubscriber\OAuth2AggregateListener*::

    namespace Application\EventSubscriber;

    use Laminas\EventManager\Event;
    use Laminas\EventManager\AbstractListenerAggregate;
    use Laminas\EventManager\EventManagerInterface;

    class OAuth2AggregateListener extends AbstractListenerAggregate
    {
        protected $handlers = array();
        protected $logInAs;

        public function attach(EventManagerInterface $events)
        {
            $this->handlers[] = $events->attach('checkUserCredentials', array($this, 'checkUserCredentials'));
        }

        /**
         * Do work such as non-standard encrypted password checking
         */
        public function checkUserCredentials(Event $e)
        {
            if ($e->getParams()['username'] == 'specialUser') {
                $e->stopPropagation();

                return true;
            }
        }
    }

.. include:: footer.rst

.. raw:: html
    :file: analytics.html
