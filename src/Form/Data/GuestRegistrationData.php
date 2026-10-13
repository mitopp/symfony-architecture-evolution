<?php

declare(strict_types=1);

namespace App\Form\Data;

use Symfony\Component\Validator\Constraints as Assert;

final class GuestRegistrationData
{
    #[Assert\NotBlank(message: 'Bitte gib deinen Namen ein.')]
    public ?string $name = null;

    // Hier könnten auch Felder wie "AGB akzeptiert" oder
    // "Passwort wiederholen" rein, ohne die Entity zu verschmutzen.
}
