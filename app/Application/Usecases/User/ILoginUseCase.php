<?php

namespace App\Application\Usecases\User;

interface ILoginUseCase
{
    public function login(): bool;
}
