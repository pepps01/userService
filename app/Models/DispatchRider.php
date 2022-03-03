<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatchRider extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $appends = ['isActive'];

    public function getisActiveAttribute(){

        if($this->status == 1){
            return 'active';
        }

        return 'inactive';
    }
}
