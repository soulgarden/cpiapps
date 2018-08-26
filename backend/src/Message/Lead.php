<?php

namespace App\Message;

/**
 * Class Lead
 * @package App\Message
 */
class Lead
{
    /**
     * @var string|null
     */
    private $agent;

    /**
     * @var string|null
     */
    private $ip;

    /**
     * @var string|null
     */
    private $stream;

    /**
     * @var string|null
     */
    private $referrer;

    /**
     * @return null|string
     */
    public function getAgent(): ?string
    {
        return $this->agent;
    }

    /**
     * @param null|string $agent
     */
    public function setAgent(?string $agent): void
    {
        $this->agent = $agent;
    }

    /**
     * @return null|string
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param null|string $ip
     */
    public function setIp(?string $ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return null|string
     */
    public function getStream(): ?string
    {
        return $this->stream;
    }

    /**
     * @param null|string $stream
     */
    public function setStream(?string $stream): void
    {
        $this->stream = $stream;
    }

    /**
     * @return null|string
     */
    public function getReferrer(): ?string
    {
        return $this->referrer;
    }

    /**
     * @param null|string $referrer
     */
    public function setReferrer(?string $referrer): void
    {
        $this->referrer = $referrer;
    }
}

