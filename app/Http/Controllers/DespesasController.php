<?php

namespace App\Http\Controllers;

use App\Http\Requests\DespesaRequest;
use App\Http\Resources\DespesasResource;
use App\Jobs\sendEmail;
use App\Models\Despesa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Notifications\notificaUser;
use Illuminate\Support\Facades\Notification;

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
    public function teste()
    {
        //sendEmail::dispatch(auth()->user())->delay(now()->addSeconds('10'));

        dd(DB::select('select * from jobs'),DB::select('select * from failed_jobs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DespesaRequest $request, $id){

        $despesa = Despesa::find(4);
        $values = $request->validated();

        $this->authorize('update',$despesa);

        $despesa->valor = $values['valor'];
        $despesa->desc  = $values['desc'];
        $despesa->data =  Carbon::createFromFormat('Y-m-d',$values['date'])->toDateTimeString();            
        $despesa->save();
        return DespesasResource::make($despesa);
        
    }
    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $show = Despesa::find($id);

        $this->authorize('view', $show);
        return DespesasResource::make($show);
    }
    public function store(DespesaRequest $req) : Response
    {
        try {
            
            //dd(auth()->user());
            $values = $req->validated();

            $desp = new Despesa();
            $desp->desc  = $values['desc'];
            $desp->data  = Carbon::createFromFormat('Y-m-d',$values['date'])->toDateTimeString();            
            $desp->user  = auth()->user()->id;
            $desp->valor = $values['valor'];
            //dd($desp);
            $desp->save();

            $user = User::find(auth()->user()->id);
            Notification::send( [$user], new notificaUser($user,$desp) );

            return Response('ok',200);

        } catch (\Throwable $th) {
            throw $th;
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = Despesa::find($id);
        $this->authorize('delete', $show);
        $show->delete();
        return DespesasResource::make($show);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\DespesaRequest  $req
     * @return \Illuminate\Http\Response
     */
    

    /* public static function notificaUsuario(User $user){
        
        try{
            //$tst = sendEmail::dispatch($user)->delay(now()->addSeconds('15'));
            //$tst1 = $user->notify(new notificaUser($user));
            $tst = 
            dd($tst);
        }catch (\Throwable $th) {
            throw $th;
        }
    } */

    

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
