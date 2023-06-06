<?php

namespace App\Entity\Trait;

use doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

trait CreatedDateTrait
{
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $CreatedDate = null;

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->CreatedDate;
    }

    public function setCreatedDate(\DateTimeInterface $CreatedDate): self
    {
        $this->CreatedDate = $CreatedDate;

        return $this;
    }
}
