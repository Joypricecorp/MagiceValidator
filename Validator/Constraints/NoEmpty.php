<?php
namespace Magice\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @author ツ Liverbool <nukboon@gmail.com>
 * @Annotation
 * @api
 */
class NoEmpty extends Constraint
{
    public $message = 'This value should not be empty.';
}