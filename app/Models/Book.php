<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table='books';
   protected $guarded=[];

   public function children(){
    return $this->hasMany(Book::class,'parent_id');
   }
      public function childrenRecursive(){
    return $this->children()->with('childrenRecursive');
   }

   public function parent(){

return $this-> belongsTo(Book::class,'parent_id');

   }
}
