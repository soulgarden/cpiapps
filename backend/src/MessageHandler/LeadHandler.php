<?php

namespace App\MessageHandler;

use App\Message\Lead;

/**
 * Class LeadHandler
 * @package App\MessageHandler
 */
class LeadHandler
{
    /**
     * @param Lead $lead
     */
    public function __invoke(Lead $lead)
    {
        var_dump('LeadHandler');
    }
}
