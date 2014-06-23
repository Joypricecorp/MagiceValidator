<?php

namespace Magice\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * @author ツ Liverbool <nukboon@gmail.com>
 * @api
 */
class PasswordValidator extends ConstraintValidator
{
    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $stringValue   = (string) $value;

        if (preg_match($constraint->ereg, $value)) {
            $this->context->addViolation(
                $constraint->message,
                array(
                    '{{ value }}' => $stringValue,
                ),
                $value
            );

            return;
        }

        $length = strlen($stringValue);

        if ($constraint->min == $constraint->max && $length != $constraint->min) {
            $this->context->addViolation(
                $constraint->exactMessage,
                array(
                    '{{ value }}' => $stringValue,
                    '{{ limit }}' => $constraint->min,
                ),
                $value,
                (int) $constraint->min
            );

            return;
        }

        if (null !== $constraint->max && $length > $constraint->max) {
            $this->context->addViolation(
                $constraint->maxMessage,
                array(
                    '{{ value }}' => $stringValue,
                    '{{ limit }}' => $constraint->max,
                ),
                $value,
                (int) $constraint->max
            );

            return;
        }

        if (null !== $constraint->min && $length < $constraint->min) {
            $this->context->addViolation(
                $constraint->minMessage,
                array(
                    '{{ value }}' => $stringValue,
                    '{{ limit }}' => $constraint->min,
                ),
                $value,
                (int) $constraint->min
            );
        }
    }
}