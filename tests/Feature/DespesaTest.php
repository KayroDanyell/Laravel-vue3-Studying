<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\DespesasController;
use App\Http\Requests\DespesaRequest;
use App\Models\Despesa;
use App\Models\User;

class DespesaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_STORE_DESPESA()
    {
        //arrange
        
        $contro = new  DespesasController();
        $req = new DespesaRequest();
        //act

        //assert

        
    }
}
