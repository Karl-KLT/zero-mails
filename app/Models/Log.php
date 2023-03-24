<?php

namespace App\Models;

use App\constants\MessageTypes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = ['type','phone_number'];

    protected $hidden = ['id','updated_at'];
    public function toArray()
    {
        return collect(parent::toArray())->merge([
            'created_at' => Carbon::create($this->created_at)->diffForHumans(null,null,true,1,null),
            'type' => MessageTypes::getOne($this->type)
        ]);
    }
}
