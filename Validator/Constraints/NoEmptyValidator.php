<?php

namespace Magice\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * @author ツ Liverbool <nukboon@gmail.com>
 * @api
 */
class NoEmptyValidator extends ConstraintValidator
{
    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof NoEmpty) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__ . '\NoEmpty');
        }

        $stringValue = '';

        if (is_string($value)) {
            $stringValue = (string) $value;
            // remove none char
            $value = preg_replace('/\W|_/u', '', $value);
        }

        if (false === $value || (empty($value) && '0' != $value)) {
            $this->context->addViolation($constraint->message, array('{{ value }}' => (string) $stringValue));
        }
    }
}