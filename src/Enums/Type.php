<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Enums;

use BenSampo\Enum\Enum;

/**
 * @property string $value
 *
 * @method static self TD01() Fattura
 * @method static self TD04() Nota di credito
 */
final class Type extends Enum {
    public const string TD01 = 'TD01';

    public const string TD02 = 'TD02';

    public const string TD03 = 'TD03';

    public const string TD04 = 'TD04';

    public const string TD05 = 'TD05';

    public const string TD06 = 'TD06';
}
