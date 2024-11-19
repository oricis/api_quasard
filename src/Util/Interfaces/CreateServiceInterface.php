<?php

declare(strict_types=1);

namespace App\Util\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface CreateServiceInterface
{
    public function create(Request $request):? object;
}
