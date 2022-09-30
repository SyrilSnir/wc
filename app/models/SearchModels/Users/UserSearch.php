<?php

namespace app\models\SearchModels\Users;

use app\core\traits\Lists\GetUserTypeListTrait;
use app\models\ActiveRecord\Users\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Description of UserSearch
 *
 * @author kotov
 */
class UserSearch extends Model
{
    public $status;
    
    public $login;
    
    public  $email;
    
    public $fio;
    
    public $user_type_id;    

    use GetUserTypeListTrait;
    
    public function rules(): array
    {
        return [
            [['login', 'fio','email', 'user_type_id', 'status'], 'safe'],  
        ];
    }
    
    public function search(array $params): ActiveDataProvider
    {
        $query = User::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_ASC]
            ]
        ]);

        $this->load($params);
        
        if (!$this->validate()) {           
            $query->where('0=1');
        } else {
            $query->andFilterWhere(['like','login', $this->login]);
            $query->andFilterWhere(['like','fio', $this->fio]);
            $query->andFilterWhere(['like','email', $this->email]);             
            $query->andFilterWhere(['user_type_id' => $this->user_type_id]);             
            $query->andFilterWhere(['status' => $this->status]);

        }
          
        return $dataProvider;
    }
}
