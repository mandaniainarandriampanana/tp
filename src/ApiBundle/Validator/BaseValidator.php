<?php

namespace ApiBundle\Validator\Article;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @DI\Service("base.validator")
 */
class BaseValidator {

    private $validator;
    private $errors;

    /**
     * @DI\InjectParams({
     *     "validator" = @DI\Inject("validator")
     * })
     */
    public function __construct(ValidatorInterface $validator) {
        $this->validator = $validator;
    }

    /**
     * @inheritDoc
     */
    public function validate($data) {
        $errors = [];
        foreach ($data as $value) {
            $constraints = [];
            foreach ($value['constraints'] as $v) {
                $constraints[] = $this->getConstraint($v);
            }
            $errors = array_merge($errors, $this->getErrorsViolation($this->validator->validate($value['value'], $constraints), $value['field']));
        }
        $this->errors = $errors;
    }

    /**
     * @inheritDoc
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * Get error message
     * 
     * @param mixed $errors
     * @param string $field
     * @return array
     */
    protected function getErrorsViolation($errors, $field) {
        $errs = [];
        if (count($errors) > 0) {
            foreach ($errors as $err) {
                $errs[] = [
                    'message' => $err->getMessage(),
                    'field' => $field
                ];
            }
        }
        return $errs;
    }

    /**
     * Get contrainst to be used.
     *
     * @param array $constr
     *
     * @return Email|NotBlank
     */
    protected function getConstraint($constr, $params = []) {
        switch ($constr) {
            case 'email':
                return new Email();
            case 'blank':
                return new NotBlank();
            case 'date':
                return new Date();
            case 'integer':
                return new Type(["type" => "integer", "message" => "type.integer.invalid"]);
            case 'length':
                return new Length($params);
            case 'bool':
                return new Range([
                    "min" => 0,
                    "max" => 1,
                    "minMessage" => "type.custom_bool.invalid",
                    "maxMessage" => "type.custom_bool.invalid"
                ]);
            default:
                return new NotBlank();
        }
    }

}
