<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'loan_bank_name',
        'loan_account_number',
        'photo',
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
