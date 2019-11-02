<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PhoneNumberValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\PhoneNumber */

        if (null === $value || '' === $value) {
            return;
        }

        if (!preg_match("/^(0)[6-7](\d{2}){4}$/", $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
