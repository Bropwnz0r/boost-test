<?php
namespace app\models\search;

use app\models\News;
use yii\data\ActiveDataProvider;

class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','description','author'], 'string']
        ];
    }
    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {

            $query->where('0=1');

            return $dataProvider;
        }

        $query->andFilterWhere([
            'title' => $this->title,
        ]);

        return $dataProvider;
    }
}