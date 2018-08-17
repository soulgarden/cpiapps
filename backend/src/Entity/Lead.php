<?php

namespace App\Entity;

use App\Entity\Common\AgentTrait;
use App\Entity\Common\IdTrait;
use App\Entity\Common\OfferTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeadRepository")
 */
class Lead
{
    use IdTrait;
    use AgentTrait;
    use OfferTrait;
}
