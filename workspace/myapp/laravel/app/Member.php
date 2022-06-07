<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $table = 'member_names';

    protected $fillable = [
        'name',
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
