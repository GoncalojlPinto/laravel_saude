<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Serviço') }}
        </h2>
    </x-slot>

<form method="POST" action="{{ route('services.update', $service->id) }}">
        @csrf @method('PUT')
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>
            <div class="col-md-6">
            <input type="text" value="{{$service->name}}" id="name" name="name" class="form-control @error('name') is-invalid @enderror" required autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">
                    {{ __("Editar") }}
                </button>
            </div>
        </div>
    </form>
</x-app-layout>
