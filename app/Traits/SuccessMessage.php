<?php
namespace App\Traits;

use Illuminate\Support\Facades\Session;

trait SuccessMessage
{
    public function getSuccessMessage($name)
    {
        return ['success'=>['message'=>$name.'created Successfully']];
    }
    public function getUpdateSuccessMessage($name)
    {
        return ['success'=>['message'=>$name.' updated Successfully']];


    }
    public function getDestroySuccessMEssage($name)
    {
        return ['success'=>['message'=>$name.' Deleted Successfully']];

    }
    public function getErrorMessage($msg)
    {
        return ['error'=> ['message'=>$msg]];
    }
}
