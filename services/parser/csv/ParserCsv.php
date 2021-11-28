<?php
namespace app\services\parser\csv;

use SplFileObject;
use yii\web\UploadedFile;
use app\services\parser\Parser;

class ParserCsv extends Parser {

    private $extFile = 'csv';
    private $needleArray = [];

    public function parse(): array
    {
        if($this->file->getExtension() == $this->extFile) {
            $header = NULL;
            if (($handle = fopen($this->file->tempName, 'r')) !== FALSE)
            {
                while (($row = fgetcsv($handle, 1000, $this->getFileDelimiter($this->file))) !== FALSE)
                {
                    if(!$header)
                        $header = $row;
                    else
                        $this->needleArray[] = array_combine($header, $row);
                }
                fclose($handle);
            }
        }

        return $this->needleArray;
    }

    private function getFileDelimiter(UploadedFile $file, $checkLines = 2){
        $file = new SplFileObject($file->tempName);
        $delimiters = array(
            ',',
            '\t',
            ';',
            '|',
            ':'
        );
        $results = array();
        $i = 0;
        while($file->valid() && $i <= $checkLines){
            $line = $file->fgets();
            foreach ($delimiters as $delimiter){
                $regExp = '/['.$delimiter.']/';
                $fields = preg_split($regExp, $line);
                if(count($fields) > 1){
                    if(!empty($results[$delimiter])){
                        $results[$delimiter]++;
                    } else {
                        $results[$delimiter] = 1;
                    }
                }
            }
            $i++;
        }
        $results = array_keys($results, max($results));
        return $results[0];
    }
}