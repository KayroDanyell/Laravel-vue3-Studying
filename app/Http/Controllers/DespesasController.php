<?php

namespace App\Http\Controllers;

use App\Http\Requests\DespesaRequest;
use App\Http\Resources\DespesasResource;
use App\Models\Despesa;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DespesasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $despesas = Despesa::all();
        //$this->authorize('view',auth()->user());
        return DespesasResource::collection($despesas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd(auth()->user());
        $despesa = Despesa::find($id);
        
        //$this->authorize('view',auth()->user());
        $this->authorize('update',$despesa);
        return DespesasResource::make($despesa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\DespesaRequest  $req
     * @return \Illuminate\Http\Response
     */
    public function store(DespesaRequest $req) : Response
    {
        try {
            //dd(auth()->user());
            $values = $req->validated();
            $desp = new Despesa();
            $desp->desc = $values['desc'];
            $desp->data = Carbon::now()->toDateTimeString(); 
            $desp->user = auth()->user()->id;
            $desp->valor = $values['valor'];
            $desp->save();
            return Response('ok',200);
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    
}