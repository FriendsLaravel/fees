<?php
use Fol\Fees\Checker\FeesEligibilityChecker;
use Fol\Fees\Models\Fees;
use Fol\Fees\Models\SubjectInterface;

function isEligibleFees(SubjectInterface $object){
    $f = new FeesEligibilityChecker();
    foreach (Fees::orderBy('position', 'asc')->get() as $fees) {
       if($f->isEligible( $object,$fees)) return $fees; 
    }
    return null;
 }
 
