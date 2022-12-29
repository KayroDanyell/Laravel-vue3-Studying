@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                
                <div class="card-header row">
                    <a class ="offset-md-8" href="/#/adicionar">
                        <button class="btn btn-primary">
                            Nova Despesa
                        
                        </button>
                    </a>    
                </div>

                


                <div class="card-body">

                    <router-view>
                    
                    </router-view>





                    
                    
                    
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
