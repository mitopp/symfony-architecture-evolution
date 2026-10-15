<?php

declare(strict_types=1);

namespace App\View;

final readonly class GuestListItem
{
    public function __construct(
        public string $name,
    ) {
    }
}
