<?php

namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class EchoEvent
 * @package AppBundle\Event
 */
class EchoEvent extends Event implements \EventBand\Event
{
    /**
     * @var array
     * @JMS\Serializer\Annotation\Type("array")
     */
    private $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->data['message'];
    }
}
