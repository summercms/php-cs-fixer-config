<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019-2020 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\License\Copyright;

/**
 * @internal
 */
final class Years
{
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param Year $start
     * @param Year $end
     *
     * @throws \InvalidArgumentException
     *
     * @return self
     */
    public static function fromRange(Year $start, Year $end): self
    {
        if ($start->greaterThan($end)) {
            throw new \InvalidArgumentException(\sprintf(
                'Start year "%s" needs to be equal to or less than end year "%s".',
                $start->toString(),
                $end->toString()
            ));
        }

        if ($start->equals($end)) {
            return self::fromYear($start);
        }

        return new self(\sprintf(
            '%s-%s',
            $start->toString(),
            $end->toString()
        ));
    }

    public static function fromYear(Year $year): self
    {
        return new self($year->toString());
    }

    public function toString(): string
    {
        return $this->value;
    }
}
