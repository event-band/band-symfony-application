<?php

namespace AppBundle\EventListener;

use AppBundle\Event\EchoEvent;
use AppBundle\Event\EchoEvents;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class EchoEventSubscriber
 * @package AppBundle\EventListener
 */
class EchoEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return [
            EchoEvents::ECHO_EVENT => 'onMessage',
        ];
    }

    /**
     * @param \AppBundle\Event\EchoEvent $event
     */
    public function onMessage(EchoEvent $event)
    {
        $message = $event->getMessage();

        $this->logger->debug(sprintf('Message from web received: %s', $message));
    }
}
