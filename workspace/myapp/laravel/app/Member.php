<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Member extends Model
{
    //
    protected $table = 'member_names';

    protected $fillable = [
        'name', 'password'
    ];

    public function showAllName(){
        return $this->all();
    }

    public function showSelectName(){
        return $this->select('name')->get();
    }
    
    public function insertName($memberName){
        return $this->create([
            'name' => $memberName,
        ]);
    }

}
