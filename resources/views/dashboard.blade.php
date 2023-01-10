<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="row">
            <div class="col-12">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </button>
                    </div>
                @endif

                @if (session()->has('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ session('danger') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-5">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row p-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-sm-12 d-flex flex-row-reverse">
                                    <a class="btn btn-primary " href="{{ route('meet.create') }}">
                                        Agregar cita
                                    </a>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table" id="meets-table">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Numero documento dueño</th>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Nombre mascota</th>
                                                <th>Fecha de cita y hora</th>
                                                <th colspan="3">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($meets as $meet)
                                                <tr>
                                                    <td>{{ $meet->document_owner }}</td>
                                                    <td>{{ $meet->name }}</td>
                                                    <td>{{ $meet->last_name }}</td>
                                                    <td>{{ $meet->pet_name }}</td>
                                                    <td>{{ $meet->meet_date->format('d-m-Y') }}
                                                        {{ $meet->meet_time->format('h:i A') }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{ route('meet.edit', [$meet->id]) }}"
                                                                class='btn btn-success'>
                                                                editar
                                                            </a>

                                                            <form method="POST"
                                                                action="{{ route('meet.destroy', [$meet->id]) }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="btn btn-danger" type="submit"
                                                                    onclick="return confirm('¿Desea cancelar la cita?')">cancelar</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start ml-2">
                                {!! $meets->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-5 mt-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row p-6">
                    <div class="card-content">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let events = {!! json_encode($events) !!}

        console.log(events);

        $('#calendar').fullCalendar({
            header: {
                left: "prev,next,today",
                center: "title",
                right: "month"
            },
            events: events,
            eventClick: function(calEvent, jsEvent, view) {
                $('#modalEvent .modal-title').html(calEvent.title);
                $('#modalEvent #horaEvento').html('Hora cita: ' + calEvent.descripcion)
                $('#modalEvent').modal("show");
            },
            dayClick: function(date, view) {
                $('#calendar').fullCalendar('changeView', 'agendaDay');
                $('#calendar').fullCalendar('gotoDate', date);
            },
            height: 550,
            weekends: true,
            locale: "es",
            selectable: true,
            editable: false,
            buttonText: {
                prev: "anterior",
                next: "siguiente"
            },
            views: {
                month: {
                    titleFormat: "MMMM YYYY",
                },
                basicDay: {
                    titleFormat: "MMMM YYYY ",
                },
            },
            columnFormat: "dddd",
            titleFormat: "DD MMMM YYYY",
            titleRangeSeparator: "/",
            timeFormat: "hh:mm A", //Da el formato para los eventos
            slotLabelFormat: [
                'hh:mm A' // Da el formato ya sea fecha u hora en la vista agenda
            ]
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="modalEvent" tabindex="-1" aria-labelledby="modalEvent" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h3 class="modal-title" id="tituloEvento"></h3>
                </div>
                <div class="modal-body">
                    <h5 id="horaEvento"></h5>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
