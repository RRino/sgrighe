@extends('layouts.app')



@section('content')


    @if ($errors->any())
        <ul class="alert alert-danger list-unstyled">
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Ruoli') }}</div>

                    <div class="card-body">
                        <a class="btn btn-success btn-sm b-add" href="{{ '/ruoli' }}" role="button">Lista
                            Ruoli</a><br><br>
                        <hr>



                        <form action="/updateRuoli" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="usr">Nome:</label>
                               
                                <input type="text" class="form-control" id="nom" name="nome"
                                    value="{{ $viewData['ruolis']->nome }}" placeholder="Inserire nome">
                                
                                    <input type="hidden" class="form-control" id="nom" name="id"
                                    value="{{ $viewData['ruolis']->id }}" placeholder="Inserire id">
                            </div>


                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary square btn-sm">Invia</button>
                        </form>
                    </div>
                    {{-- $viewData['iscrizioni']->links() --}}
                    <br>

                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
@endsection
