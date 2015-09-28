<?php

namespace yii\boost\db;

use Exception,
    FB,
    yii\boost\base\InvalidModelException,
    yii\helpers\VarDumper,
    Yii,
    yii\db\ActiveRecord as YiiActiveRecord;


class ActiveRecord extends YiiActiveRecord
{

    /**
     * @return ActiveQuery
     */
    public static function find()
    {
        return Yii::createObject(ActiveQuery::className(), [get_called_class()]);
    }

    public function log($message = 'dump', $category = 'application')
    {
        if ($this->hasErrors()) {
            $data = [
                'class' => get_class($this),
                'attributes' => $this->getAttributes(),
                'errors' => $this->getErrors()
            ];
            Yii::error($message . PHP_EOL . VarDumper::dumpAsString($data), $category);
        } else {
            $data = [
                'class' => get_class($this),
                'attributes' => $this->getAttributes()
            ];
            Yii::info($message . PHP_EOL . VarDumper::dumpAsString($data), $category);
        }
    }

    public function fb($label = null)
    {
        if ($this->hasErrors()) {
            $data = [
                'class' => get_class($this),
                'attributes' => $this->getAttributes(),
                'errors' => $this->getErrors()
            ];
        } else {
            $data = [
                'class' => get_class($this),
                'attributes' => $this->getAttributes()
            ];
        }
        FB::log($data, $label);
    }

    public function dump()
    {
        if ($this->hasErrors()) {
            $data = [
                'class' => get_class($this),
                'attributes' => $this->getAttributes(),
                'errors' => $this->getErrors()
            ];
        } else {
            $data = [
                'class' => get_class($this),
                'attributes' => $this->getAttributes()
            ];
        }
        VarDumper::dump($data);
    }

    public function dumpAsString()
    {
        if ($this->hasErrors()) {
            $data = [
                'class' => get_class($this),
                'attributes' => $this->getAttributes(),
                'errors' => $this->getErrors()
            ];
        } else {
            $data = [
                'class' => get_class($this),
                'attributes' => $this->getAttributes()
            ];
        }
        return VarDumper::dumpAsString($data);
    }

    /**
     * @return InvalidModelException
     */
    public function exception($message = null, $code = 0, Exception $previous = null)
    {
        return new InvalidModelException($this, $message, $code, $previous);
    }
}
