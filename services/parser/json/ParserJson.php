<?php
namespace app\services\parser\json;

use app\services\parser\helpers\ArrayTrait;
use yii\helpers\Json;
use app\services\parser\Parser;
use yii\web\BadRequestHttpException;
use yii\base\InvalidArgumentException;

class ParserJson extends Parser {
    use ArrayTrait;

    private $extFile = 'json';
    private $needleArray = [];

    /**
     * Parse specific json file
     * @throws BadRequestHttpException
     */
    public function parse(): array
    {
        if($this->file->getExtension() == $this->extFile) {
            try {
                $json = Json::decode(file_get_contents($this->file->tempName));
            }
            catch (InvalidArgumentException $e) {
                throw new BadRequestHttpException('Invalid JSON data in file: ' . $e->getMessage());
            }
            $this->needleArray = $this->getFieldForKeys($json, $this->requiredFields);
        }

        return $this->needleArray;
    }

}