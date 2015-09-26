<?php

namespace yii\boost\db;

use Exception,
    yii\base\Model,
    UnexpectedValueException;


class InvalidModelException extends UnexpectedValueException
{

    /**
     * @var Model
     */
    private $_model = null;

    public function __construct(Model $model, $message = null, $code = 0, Exception $previous = null)
    {
        $this->_model = $model;
        parent::__construct($message, $code, $previous);
    }

    public function getName()
    {
        return 'Invalid Model';
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->_model;
    }
}
