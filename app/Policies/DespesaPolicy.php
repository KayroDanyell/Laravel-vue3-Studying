<?php

namespace App\Policies;

use App\Models\Despesa;
use App\Models\User;
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

    public function view(User $user){
        return true;
    }

    public function update(Despesa $despesa){
        if($despesa->user == auth()->user()->id){
            return true;
        }else {
            return false;
        }
    }
}
