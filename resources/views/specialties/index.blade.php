<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Medicos') }}
        </h2>
    </x-slot>

    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a class="btn btn-info" href="{{ route('specialties.create') }}" title="{{ __('Nova Especialidade')}}"> {{ __('Nova Especialidade')}} </a>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>{{ __('Id') }}</td>
                <td>{{ __('Nome') }}</td>
                <td>{{ __('Acções') }}</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($specialties as $specialty)
                <tr>
                    <td>{{ $specialty->id }}</td>
                    <td>{{ $specialty->name }}</td>
                    <td>
                        <div class="d-flex align-items-center justify-content-around">
                            <a class="btn btn-small btn-success" href="{{ route('specialties.show', $specialty->id) }}"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-small btn-info" href="{{ route('specialties.edit', $specialty->id) }}"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('specialties.destroy', $specialty->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-small btn-danger"><i class="fa fa-times"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
</x-app-layout>
