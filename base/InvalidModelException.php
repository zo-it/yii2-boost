<?php

namespace yii\boost\base;

use Exception,
    yii\base\Model,
    UnexpectedValueException,
    yii\helpers\VarDumper;


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

    public function __toString()
    {
        $model = $this->getModel();
        if ($model->hasErrors()) {
            $info = [
                'class' => get_class($model),
                'attributes' => $model->getAttributes(),
                'errors' => $model->getErrors()
            ];
        } else {
            $info = [
                'class' => get_class($model),
                'attributes' => $model->getAttributes()
            ];
        }
        return parent::__toString() . PHP_EOL . VarDumper::dumpAsString($info);
    }
}
