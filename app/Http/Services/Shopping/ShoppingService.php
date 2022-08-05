<?php
namespace App\Http\Services\Shopping;

use App\Http\Resources\Shopping\ShoppingResource;
use App\Models\Shopping\Shopping;

class ShoppingService {

  private Shopping $shopping;

  public function getAllPaginate($params) {
    
    return ShoppingResource::collection(
      Shopping::paginate($params['per_page'])
    );
  }

  public function findById($id) {
    
    return Shopping::query()->findOrFail($id);
  }

  public function findMany($data) {
    
    return Shopping::query()->find($data);
  }

  public function getById($id) {

    $shopping = $this->findById($id); 
    
    return new ShoppingResource(
      $shopping
    );
  }

  public function create($model) {
    
    $this->shopping = new Shopping();

    $this->shopping->name = $model->shopping['name'];
    $this->shopping->created_at = $model->shopping['createddate'];

    $this->shopping->save();

    return $this->shopping;
  }

  public function update($model,$id) {
    
    $this->shopping = $this->findById($id);

    $this->shopping->name = $model->shopping['name'];
    $this->shopping->created_at = $model->shopping['createddate'];

    $this->shopping->save();

    return $this->shopping;
  }

  public function delete($id) {
    $this->shopping = $this->findById($id);

    $this->shopping->delete();

    return $this->shopping;
  }

}
