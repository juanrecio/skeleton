<?php

namespace Domain\EventSubscriber;

use Domain\Event\UserWasPut;
use Drift\HttpKernel\Event\DomainEventEnvelope;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PrintUserOnPut implements EventSubscriberInterface
{

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
     *  * ['eventName' => 'methodName']
     *  * ['eventName' => ['methodName', $priority]]
     *  * ['eventName' => [['methodName1', $priority], ['methodName2']]]
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [UserWasPut::class => 'printUser'];
    }

    public function printUser(DomainEventEnvelope $envelope){
        /** @var UserWasPut $event */
        $event = $envelope->getDomainEvent();
        echo 'User '.$event->getUser()->getId(). ' was put';
    }
}
