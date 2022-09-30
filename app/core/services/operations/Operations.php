<?php

namespace app\core\services\operations;

use app\core\repositories\manage\ManagedRepositoryInterface;
use app\models\ActiveRecord\ManagedModelInterface;
use app\models\Forms\Manage\ManageForm;
use yii\db\ActiveRecord;

/**
 * Description of Operations
 *
 * @author kotov
 */
abstract class Operations implements DataManqageInterface
{
    /**
     * 
     * @var ManagedRepositoryInterface
     */
    protected $repository;
    
    public function __construct(ManagedRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
   public function create(ManageForm $form): ActiveRecord
   {
        //$model = City::create($form);
        $model = call_user_func([$this->repository->modelName(), 'create'], $form);
        $this->repository->save($model);
        return $model;
   }
   
   public function edit(int $id, ManageForm $form):void
   {
       /** @var ManagedModelInterface $model */
        $model = $this->repository->get($id);
        $model->edit($form);
        $this->repository->save($model);
   }
   
   public function remove(int $id):void
   {
       /** @var ManagedModelInterface $model */
        $model = $this->repository->get($id);
        $this->repository->remove($model);
   }

}
