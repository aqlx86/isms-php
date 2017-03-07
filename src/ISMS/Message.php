<?php

namespace ISMS;

use ISMS\Recipient;

class Message
{
    const TYPE_ASCII = 1;
    const TYPE_UNICODE= 2;

    protected $recipient;
    protected $message;
    protected $type;
    protected $sender_id;

    public function __construct(Recipient $recipient, $message, $type = self::TYPE_ASCII, $sender_id = null)
    {
        $this->recipient = $recipient;
        $this->message = $message;
        $this->type = $type;
        $this->sender_id = $sender_id;
    }

    public function recipient()
    {
        if ($this->recipient->type() == Recipient::RCP_NUMBER)
            return implode(';', $this->recipient->recipients());

        return $this->recipient;
    }

    public function message()
    {
        return $this->message;
    }

    public function type()
    {
        return $this->type;
    }

    public function sender_id()
    {
        return $this->sender_id;
    }

    public function to_array()
    {
        return [
            $this->recipient->type() => $this->recipient(),
            'msg' => $this->message(),
            'type' => $this->type(),
            'senderid' => $this->sender_id
        ];
    }

    public function __toString()
    {
        return http_build_query([
            $this->recipient->type() => $this->recipient(),
            'msg' => $this->message(),
            'type' => $this->type(),
            'senderid' => $this->sender_id
        ]);
    }
}
