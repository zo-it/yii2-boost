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

    public function dumpData()
    {
        if ($this->hasErrors()) {
            return [
                'class' => get_class($this),
                'attributes' => $this->getAttributes(),
                'errors' => $this->getErrors()
            ];
        } else {
            return [
                'class' => get_class($this),
                'attributes' => $this->getAttributes()
            ];
        }
    }

    public function log($message = 'dump', $category = 'application')
    {
        if ($this->hasErrors()) {
            Yii::error($message . PHP_EOL . VarDumper::dumpAsString($this->dumpData()), $category);
        } else {
            Yii::info($message . PHP_EOL . VarDumper::dumpAsString($this->dumpData()), $category);
        }
    }

    public function fb($label = null)
    {
        FB::log($this->dumpData(), $label);
    }

    public function dump()
    {
        VarDumper::dump($this->dumpData());
    }

    public function dumpAsString()
    {
        return VarDumper::dumpAsString($this->dumpData());
    }

    /**
     * @return InvalidModelException
     */
    public function exception($message = null, $code = 0, Exception $previous = null)
    {
        return new InvalidModelException($this, $message, $code, $previous);
    }
}
