<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inserir Novo Médico') }}
        </h2>
    </x-slot>


<form action="{{ route('medicos.store')}}" method="POST">
    @csrf
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>
        <div class="col-md-6">
            <input type="text" id="name" class="form-control" name="name" required autofocus>
        </div>
    </div>
    <div class="form-group row">
        <label for="adress" class="col-md-4 col-form-label text-md-right">{{ __('Morada') }}</label>
        <div class="col-md-6">
            <input type="text" id="address" class="form-control" name="address" required autofocus>
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>
        <div class="col-md-6">
            <input type="text" id="phone" class="form-control" name="phone" required autofocus>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary" {{ redirect((route('medicos.index'))) }}>
                {{ __("Adicionar")  }}
            </button>
        </div>
    </div>
</form>

</x-app-layout>
