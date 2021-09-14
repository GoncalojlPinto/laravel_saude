<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class='container'>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> {{ __('Médico') }} </div>
                    <div class="card-body">
                        <h4><strong>{{ $medico->name ??  __('Sem Nome') }} </strong></h4>
                        <hr>
                        <p> {{ $medico->phone }} <br>
                            {{ $medico->address }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
