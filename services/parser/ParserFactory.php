<?php
namespace app\services\parser;

use yii\web\UploadedFile;
use app\services\parser\csv\ParserCsv;
use app\services\parser\json\ParserJson;
use app\services\parser\yaml\ParserYaml;

class ParserFactory {

    public static function getParser (UploadedFile $file, array $attributes) : Parser {
        switch ($file->getExtension()){
            case 'json':
                return new ParserJson($file, $attributes);
            case 'csv':
                return new ParserCsv($file, $attributes);
            case 'yaml':
                return new ParserYaml($file, $attributes);
            default:
                throw new \InvalidArgumentException("Invalid parser format");
        }
    }
}