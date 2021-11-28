<?php

namespace app\models\forms;



use yii\base\Model;
use app\models\News;
use yii\web\UploadedFile;
use app\services\parser\ParserFactory;


/**
 * News form is the model behind the news form.
 */
class NewsForm extends Model
{
    public $title;
    public $description;
    public $author;
    public $fileImport;
    /**
     * @var array app\models\News
     */
    private $models = [];

    public function afterValidate()
    {
        $this->loadModels();
        parent::afterValidate();
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['title', 'description','author'], 'required', 'when' => function($model) {
                return is_file($model->fileImport);
            }, 'whenClient' => "function (attribute, value) {
                return $('#newsform-fileimport').val() == 0;
            }"],
            [['title', 'description', 'author'], 'string', 'max' => 255],
            [['fileImport'], 'file', 'extensions' => 'json, csv, yaml']
        ];
    }

    /**
     *
     */
    public function loadModels()
    {
        $model = new News();
        if(UploadedFile::getInstance($this, 'fileImport')){
            $parser = ParserFactory::getParser(UploadedFile::getInstance($this, 'fileImport'), array_keys($model->getAttributes(null,['id'])));
            $data = $parser->parse();
            foreach ($data as $item) {
                $model = new News();
                if($model->load($item, '') && $model->validate()) {
                    $this->models[] = $model;
                }
            }
        }else{
            $model->title = $this->title;
            $model->description = $this->description;
            $model->author = $this->author;
            if($model->validate()){
                $this->models[] = $model;
            }
        }
    }

    /**
     * Save all models without validation but validation was previously
     */
    public function save() : bool
    {
        foreach ($this->models as $model) {
            $model->save(false);
        }

        return TRUE;
    }
}
