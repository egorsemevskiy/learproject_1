<?php

namespace Sem\Traits;

trait IdentityTrait
{
    public function generateId(): string
    {
        return uniqid();
    }
}