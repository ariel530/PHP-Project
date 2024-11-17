<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tasks')]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $createdAt;

    public function __construct(string $title)
    {
        $this->title = $title;
        $this->createdAt = new \DateTime();
    }

    public function getId(): int { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function getCreatedAt(): \DateTime { return $this->createdAt; }
}


