<?php

namespace ISMS;

class Recipient
{
    const RCP_NUMBER = 'dstno';
    const RCP_GROUP = 'groupid';
    const RCP_NAME = 'name';

    protected $type;
    protected $recipients;

    public function __construct($value = null, $type = self::RCP_NUMBER)
    {
        $this->type = $type;

        if ($value)
            $this->add_recipient($value);
    }

    public function add_recipient($recipient)
    {
        if ($this->type != self::RCP_NUMBER && count($this->recipients) != 0)
            throw new \InvalidArgumentException('Only number type can have multiple recipient');

        $this->recipients[] = $recipient;
    }

    public function type()
    {
        return $this->type;
    }

    public function recipients()
    {
        return $this->recipients;
    }
}