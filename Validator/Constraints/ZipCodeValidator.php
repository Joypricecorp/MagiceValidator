<?php
namespace Magice\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ZipCodeValidator extends ConstraintValidator
{
    /*
        * Very simple validation logic to test german zip codes,
        * usually german zip codes consists of 5 digits
        */
    private function isValidZipCode($value)
    {
        return 0 === preg_match('/\d{5}/', $value);
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ZipCode) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__ . '\ZipCode');
        }

        if ($this->isValidZipCode($value) === false) {
            $this->context->addViolation($constraint->message, array('{{ value }}' => (string) $value));

            return false;
        }

        return true;
    }

    public function validatedBy() {
        return "ZipCode";
    }
}