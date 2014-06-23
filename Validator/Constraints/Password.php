<?php
namespace Magice\Validator\Constraints;

use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Symfony\Component\Validator\Constraint;

/**
 * @author ツ Liverbool <nukboon@gmail.com>
 * @Annotation
 * @api
 */
class Password extends Constraint
{
    public $message = 'This Password ({{ value }}) is not allowed.';
    public $maxMessage = 'Password is too long. It should have {{ limit }} character or less.|Password is too long. It should have {{ limit }} characters or less.';
    public $minMessage = 'Password is too short. It should have {{ limit }} character or more.|Password is too short. It should have {{ limit }} characters or more.';
    public $exactMessage = 'Password should have exactly {{ limit }} character.|Password should have exactly {{ limit }} characters.';
    public $min = 4;
    public $max = 20;
    public $ereg = null;

    public function __construct($options = null)
    {

        if (null !== $options && !is_array($options)) {
            $options = array(
                'min' => $options,
                'max' => $options,
            );
        }

        parent::__construct($options);

        if(null === $this->ereg) {
            $this->ereg = '/[^a-z0-9' . preg_quote('\'~`!@#$%^&*()_-+={}[]|;:"<>,.\?') .']/i';
        }

        if (empty($this->min) || empty($this->max)) {
            throw new MissingOptionsException(sprintf('Either option "min" or "max" must be given for constraint %s', __CLASS__), array('min', 'max'));
        }
    }
}