<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\TodoList;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title','todo_list_id','status','description','label_id'];

    public const STARTED = 'started';
    public const PENDING = 'pending';
    public const NOT_STARTED = 'not_started';

   public function todo_list(): BelongsTo
   {
       return $this->belongsTo(TodoList::class);
   }

}
