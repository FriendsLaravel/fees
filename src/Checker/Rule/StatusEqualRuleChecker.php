<?php

namespace Fol\Fees\Checker\Rule;

use Fol\Fees\Models\SubjectInterface;

final class StatusEqualRuleChecker implements RuleCheckerInterface
{
    public const TYPE = 'status_equal';

    public static function isEligible(SubjectInterface $subject, array $configuration): bool
    {
        return $subject->getCheckerStatus() == $configuration['status'];
    }
}