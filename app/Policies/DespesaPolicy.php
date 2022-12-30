<?php

namespace App\Policies;

use App\Models\Despesa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class DespesaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user,Despesa $despesa){

        if($despesa->user == $user->id){
            return true;
        }else {
            return false;
        }
    }

    public function update(User $user,Despesa $despesa){
        
        $dif = Carbon::parse($despesa->data)->diffInDays(Carbon::now());

        if($despesa->user == $user->id && $dif <=30){
            return true;
        }else {
            return false;
        }
    }
}
