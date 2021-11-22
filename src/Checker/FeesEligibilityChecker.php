<?php
namespace Fol\Fees\Checker;

use Fol\Fees\Checker\Rule\DateLessOrEqualRuleChecker;
use Fol\Fees\Checker\Rule\StatusEqualRuleChecker;
use Fol\Fees\Models\SubjectInterface;
use Fol\Fees\Models\Fees;
use Fol\Fees\Models\FeesRule;

final class FeesEligibilityChecker{

    private $ruleRegistry = [
        DateLessOrEqualRuleChecker::TYPE => DateLessOrEqualRuleChecker::class,
        StatusEqualRuleChecker::TYPE => StatusEqualRuleChecker::class
    ];

    public function isEligible(SubjectInterface $subject,Fees $fees){
        if (!$fees->rules) {
            return true;
        }
      
        
        foreach ($fees->rules as $rule) {
            if (!$this->isEligibleToRule($subject, $rule)) {
                return false;
            }
        }
        return true;
    }
    
    private function isEligibleToRule(SubjectInterface $subject, FeesRule $rule): bool
    {
        /** @var RuleCheckerInterface $checker */
        $checker = $this->ruleRegistry[$rule->type];

        return $checker::isEligible($subject, $rule->configuration);
    }
}