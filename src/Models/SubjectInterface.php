<?php

namespace Fol\Fees\Models;


interface SubjectInterface
{
    public function getCheckerDate(): \DateTime;

    public function getCheckerStatus(): string;

}