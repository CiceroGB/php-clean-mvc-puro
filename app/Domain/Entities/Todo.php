<?php

namespace App\Domain\Entities;

class Todo
{
    private int $id;
    private string $title;
    private int $done;

    public function __construct(int $id, string $title, int $done)
    {
        $this->id = $id;
        $this->title = $title;
        $this->done = $done;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function isDone(): int
    {
        return $this->done;
    }
}
