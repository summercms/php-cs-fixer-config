<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019-2020 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\Test\Unit\RuleSet;

use Ergebnis\PhpCsFixer\Config;

/**
 * @internal
 */
abstract class ExplicitRuleSetTestCase extends AbstractRuleSetTestCase
{
    final public function testIsExplicitRuleSet(): void
    {
        $ruleSet = self::createRuleSet();

        self::assertInstanceOf(Config\RuleSet\ExplicitRuleSet::class, $ruleSet);
    }

    final public function testRuleSetDoesNotConfigureRuleSets(): void
    {
        $namesOfRulesThatAreConfigured = \array_keys(self::createRuleSet()->rules());

        $namesOfRulesThatAreConfiguredAndReferenceRuleSets = \array_filter($namesOfRulesThatAreConfigured, static function (string $ruleName): bool {
            return '@' === \mb_substr($ruleName, 0, 1);
        });

        self::assertEmpty($namesOfRulesThatAreConfiguredAndReferenceRuleSets, \sprintf(
            "Failed asserting that rule set \"%s\" does not configure rule sets. Rule sets with names\n\n%s\n\nshould not be used.",
            static::className(),
            ' - ' . \implode("\n - ", $namesOfRulesThatAreConfiguredAndReferenceRuleSets)
        ));
    }
}
