<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inserir novo médico') }}
        </h2>
    </x-slot>

<form method="POST" action="{{ route('medicos.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>
            <div class="col-md-6">
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" required autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="adress" class="col-md-4 col-form-label text-md-right">{{ __('Morada') }}</label>
            <div class="col-md-6">
                <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" required autofocus>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>
            <div class="col-md-6">
                <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" required autofocus>
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="specialty" class="col-md-4 col-form-label text-md-right">{{ __('Especialidade') }}</label>
            <div class="col-md-6">
                <select class="custom-select" name="specialty">
                    @foreach ($specialities as $specialty )
                        <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="servicos" class="col-md-4 col-form-label text-md-right">{{ __('Serviço') }}</label>
            <div class="col-md-6">
                <select class="custom-select" name="service">
                    @foreach ($services as $service )
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Foto perfil') }}</label>
            <div class="col-md-6">
                <input type="file" id="photo" name="photo" class="form-control @error('photo') is-invalid @enderror" autofocus>
                @error('photo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">
                    {{ __("Adiconar") }}
                </button>
            </div>
        </div>
    </form>
</x-app-layout>
