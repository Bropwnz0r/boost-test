<?php
namespace app\services\parser;

use yii\web\UploadedFile;

abstract class Parser {

    protected $file;

    protected $requiredFields;

    public function __construct(UploadedFile $file, $requiredFields = []) {
        $this->file = $file;
        $this->requiredFields = $requiredFields;
    }

    abstract function parse() : array ;



}