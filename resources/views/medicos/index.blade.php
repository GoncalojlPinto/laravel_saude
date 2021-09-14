<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Medicos') }}
        </h2>
    </x-slot>

<a class="btn btn-info" href="{{ route('medicos.create') }}" title="{{ __('Novo Médico') }}">
    {{ __('Novo Médico') }}
</a>

<table class="table table-striped table-bordered">
        <thead>
            <tr>
            <td> {{ __('Nome') }}</td>
            <td> {{ __('Morada') }}</td>
            <td> {{ __('Telefone') }}</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicos as $medico)
            <tr>

                <td>{{ $medico->name }}</td>
                <td> {{ $medico->address }}</td>
                <td> {{ $medico->phone }}</td>
                <td> <a class="btn btn-smal btn-sucess" href="{{ route('medicos.show', $medico->id) }}">
                    <i class="fa fa-eye">
                    </i></a></td>

            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
