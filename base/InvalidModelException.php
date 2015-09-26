<?php

namespace yii\boost\db;

use UnexpectedValueException;


class InvalidModelException extends UnexpectedValueException
{

    public function getName()
    {
        return 'Invalid Model';
    }
}
