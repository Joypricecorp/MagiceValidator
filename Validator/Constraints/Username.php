<?php
namespace Magice\Validator\Constraints;

use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Symfony\Component\Validator\Constraint;

/**
 * @author ツ Liverbool <nukboon@gmail.com>
 * @Annotation
 * @api
 */
class Username extends Constraint
{
    public $message = 'This username ({{ value }}) already used.';
    public $maxMessage = 'Username is too long. It should have {{ limit }} character or less.|Username is too long. It should have {{ limit }} characters or less.';
    public $minMessage = 'Username is too short. It should have {{ limit }} character or more.|Username is too short. It should have {{ limit }} characters or more.';
    public $exactMessage = 'Username should have exactly {{ limit }} character.|Username should have exactly {{ limit }} characters.';
    public $reservedWords = null;
    public $min = 3;
    public $max = 20;
    public $ereg = '/[^a-z\._\-0-9]/i';

    public function __construct($options = null)
    {
        if (null !== $options && !is_array($options)) {
            $options = array(
                'min' => $options,
                'max' => $options,
            );
        }

        parent::__construct($options);

        if (empty($this->min) || empty($this->max)) {
            throw new MissingOptionsException(sprintf('Either option "min" or "max" must be given for constraint %s', __CLASS__), array('min', 'max'));
        }
    }
}