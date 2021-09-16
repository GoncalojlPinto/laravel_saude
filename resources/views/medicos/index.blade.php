<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Medicos') }}
        </h2>
    </x-slot>

    @if (Session::has('message'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('message') }}
      </div>
    @endif

    <a class="btn btn-info" href="{{ route('medicos.create') }}" title="{{ __('Novo Médico') }}">
        {{ __('Novo Médico') }}
    </a>

    <table class="table table-striped table-bordered ">
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

                <td> {{ $medico->name }}</td>
                <td> {{ $medico->address }}</td>
                <td> {{ $medico->phone }}</td>
                <td><div class="d-flex align-items-center justify-content-around">
                        <a class="btn btn-small btn-success" href="{{ route('medicos.show', $medico->id) }}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-small btn-warning" href="{{ route('medicos.edit', $medico->id) }}"><i class="fa fa-edit">
                        </i></a>
                        <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-small btn-danger"><i class="fa fa-times">
                            </i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
