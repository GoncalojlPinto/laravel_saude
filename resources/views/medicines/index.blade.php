<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Medicamentos') }}
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

    <a class="btn btn-info" href="{{ route('medicines.create') }}" title="{{ __('Novo Medicamento')}}"> {{ __('Novo Medicamento')}} </a>

    <table class="table table-striped table-bordered mt-3">
        <thead>
            <tr>
                <td>{{ __('Name') }}</td>
                <td>{{ __('brand') }}</td>
                <td>{{ __('Drug') }}</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicines as $medicine)
                <tr>
                    <td>{{ $medicine->getId() }}</td>
                    <td>{{ $medicine->getBrand() }}</td>
                    <td>{{ $medicine->getDrug() }}</td>
                        <div class="d-flex align-items-center justify-content-around">
                            <a class="btn btn-small btn-success" href="{{ route('medicines.show', $medicine->getId()) }}"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-small btn-info" href="{{ route('medicines.edit', $medicine->getId()) }}"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('medicines.destroy', $medicine->getId()) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-small btn-danger"><i class="fa fa-times"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
</x-app-layout>
