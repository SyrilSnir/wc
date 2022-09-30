<?php

use app\core\helpers\View\User\UserStatusHelper;
use app\models\ActiveRecord\Users\User;
use app\models\SearchModels\Users\UserSearch;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use kartik\grid\ActionColumn;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $searchModel UserSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Управление пользователями';
$this->params['breadcrumbs'][] = $this->title;
$adminList = Yii::$app->params['rootUsers'] ?? [];
$action = Yii::$app->getRequest()->getPathInfo();
?>
<section class="content-large container-fluid">
    <div class="card">
<?php 

// Добавление нового пользователя из панели администратора не имеет смысла
    $rowsCountTemplate = require Yii::getAlias('@elements') . DIRECTORY_SEPARATOR . 'page-counter.php';
    $columnsConfig = [                    
                    'toolbar' => [
                        [
                            'content'=> $rowsCountTemplate .                            
                                Html::a('<i class="fas fa-redo"></i>', [''], [
                                    'class' => 'btn btn-outline-secondary',
                                    'title'=> 'По умолчанию',
                                    'data-pjax'=> '', 
                                ]) .
                                Html::a('<i class="fas fa-trash"></i>', ['trash'], [
                                    'class' => 'btn btn-outline-secondary',
                                    'title'=> 'Корзина',                                     
                                ]) .                             
                                Html::a('<i class="fas fa-plus"></i>',['create'], [
                                    'class' => 'btn btn-success',
                                    'title' => 'Добавить пользователя',
                                ]),
                        ],
                    ],                   
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [ 
                        [
                            'attribute' => 'login',
                            'label' => 'Логин',
                            'width' => '110px'
                        ],
                        'email:text:'.'E-mail',
                        'fio:text:'.'ФИО',
                        [
                            'attribute' => 'user_type_id',
                            'label' => 'Тип учетной записи',
                            'filterType' => GridView::FILTER_SELECT2,                               
                            'filter' => $searchModel->userTypeList(),
                            'filterWidgetOptions' => [
                                'options' => ['placeholder' => ''],
                            ],                              
                            'value' => 'userType.name'
                        ],
                        [
                            'attribute' => 'status',
                            'label' => 'Status',
                            'width' => '200px',
                            'format' => 'raw',                           
                            'filterType' => GridView::FILTER_SELECT2,                            
                            'filter' => UserStatusHelper::statusList(),
                            'filterWidgetOptions' => [
                                'options' => ['placeholder' => ''],
                            ],                            
                            'value' => function (User $model) {
                                return UserStatusHelper::getStatusLabel($model->status);
                            }
                        ],                        
                        [ 
                            'class' => ActionColumn::class,
                            'width' => '100px',                  
                        ],
                    ],
                ];
        $gridConfig = require Yii::getAlias('@config') . DIRECTORY_SEPARATOR . 'kartik.gridview.php';
        $fullGridConfig = array_merge($columnsConfig,$gridConfig);
 ?>
        <div class="card-body">
          <?php Pjax::begin(); ?>
                <?= GridView::widget($fullGridConfig); ?>
          <?php Pjax::end(); ?>
        </div>
    </div>
</section>


