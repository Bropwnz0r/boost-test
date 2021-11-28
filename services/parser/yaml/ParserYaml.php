<?php
namespace app\services\parser\yaml;

use app\services\parser\Parser;
use app\services\parser\helpers\ArrayTrait;

class ParserYaml extends Parser {

    use ArrayTrait;

    private $extFile = 'yaml';
    private $needleArray = [];

    public function parse(): array
    {
        if($this->file->getExtension() == $this->extFile) {
            $this->needleArray = $this->getFieldForKeys(yaml_parse(file_get_contents($this->file->tempName)), $this->requiredFields);
        }

        return $this->needleArray;
    }
}