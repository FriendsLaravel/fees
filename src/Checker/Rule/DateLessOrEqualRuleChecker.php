<?php

namespace Fol\Fees\Checker\Rule;

use Fol\Fees\Models\SubjectInterface;

final class DateLessOrEqualRuleChecker implements RuleCheckerInterface
{
    public const TYPE = 'date_less_or_equal';

    public static function isEligible(SubjectInterface $subject, array $configuration): bool
    {
        return $subject->getCheckerDate()->modify('-'.$configuration['date'].' hours') <= now();
    }
}