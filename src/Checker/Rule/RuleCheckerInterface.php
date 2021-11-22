<?php

namespace Fol\Fees\Checker\Rule;

use Fol\Fees\Models\SubjectInterface;

interface RuleCheckerInterface
{
    public static function isEligible(SubjectInterface $subject, array $configuration): bool;
}