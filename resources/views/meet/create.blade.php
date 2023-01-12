<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="container py-4">
                    @if (session()->has('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session()->has('danger'))
                        <div class="alert alert-danger">{{ session('danger') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <div class="col-sm-12 d-flex flex-row-reverse">
                                <a class="btn btn-primary" href="{{ route('dashboard') }}">
                                    Atrás
                                </a>
                            </div>
                        </div>
                        <div class="card-content p-4">
                            <form method="POST" action="{{ route('meet.store') }}" id="validateForm">
                                @csrf

                                @include('meet.fields')

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <input type="submit" value="Enviar" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                </main>
            </div>

        </div>
    </div>
</x-app-layout>
