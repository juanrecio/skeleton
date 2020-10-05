<?php

namespace Domain\Model\User;

use function React\Promise\resolve;

class User
{

    private $id;

    private $name;

    public function __construct(string $id,string $name)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
        resolve()
    }


    public function getName(): string
    {
        return $this->name;
    }


}
