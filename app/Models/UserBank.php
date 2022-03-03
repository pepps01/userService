<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_id',
        'account_name',
        'account_number',
        'account_no',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bank(){
        return $this->belongsTo(Bank::class);
    }

    protected $appends = ['isActive'];

    public function getisActiveAttribute(){

        if($this->status == 1){
            return 'active';
        }

        return 'inactive';
    }
}
