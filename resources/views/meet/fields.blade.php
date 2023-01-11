<div class="row">
    <div class="col-4">
        <label for="document_owner" class="control-label">Número de documento del
            dueño:</label>
        <input class="form-control" name="document_owner" {{ $errors->has('document_owner') ? 'is-invald' : '' }}
            value="{{ old('document_owner', $meet->document_owner) }}" id="document_owner">
        @if ($errors->has('document_owner'))
            <small class="text-danger">{{ $errors->first('document_owner') }}</small>
        @endif
    </div>
    <div class="col-4">
        <label for="name" class="control-label">Nombres:</label>
        <input class="form-control" name="name" {{ $errors->has('name') ? 'is-invald' : '' }}
            value="{{ old('name', $meet->name) }}" id="name">
        @if ($errors->has('name'))
            <small class="text-danger">{{ $errors->first('name') }}</small>
        @endif
    </div>
    <div class="col-4">
        <label for="last_name" class="control-label">Apellidos:</label>
        <input class="form-control" name="last_name" {{ $errors->has('last_name') ? 'is-invald' : '' }}
            value="{{ old('last_name', $meet->last_name) }}" id="last_name">
        @if ($errors->has('last_name'))
            <small class="text-danger">{{ $errors->first('last_name') }}</small>
        @endif
    </div>
</div>
<div class="row mt-3">
    <div class="col-4">
        <label for="pet_name" class="control-label">Nombre mascota:</label>
        <input class="form-control" name="pet_name" {{ $errors->has('pet_name') ? 'is-invald' : '' }}
            value="{{ old('pet_name', $meet->pet_name) }}" id="pet_name">
        @if ($errors->has('pet_name'))
            <small class="text-danger">{{ $errors->first('pet_name') }}</small>
        @endif
    </div>
    <div class="col-4">
        <label for="meet_date">Escoje la fecha de cita:</label>
        <input type="date" name="meet_date" id="meet_date" class="form-control"
            value="{{ old('meet_date', Carbon\Carbon::parse($meet->meet_date)->format('Y-m-d')) }}"
            {{ $errors->has('meet_date') ? 'is-invald' : '' }} id="meet_date">
        @if ($errors->has('meet_date'))
            <small class="text-danger">{{ $errors->first('meet_date') }}</small>
        @endif
    </div>
    <div class="col-4">
        <label for="meet_time">Escoge la hora de la cita:</label>
        <input type="time" name="meet_time" class="form-control" {{ $errors->has('meet_time') ? 'is-invald' : '' }}
            value="{{ old('meet_time', Carbon\Carbon::parse($meet->meet_time)->format('H:i')) }}" id="meet_time">
        @if ($errors->has('meet_time'))
            <small class="text-danger">{{ $errors->first('meet_time') }}</small>
        @endif
    </div>
</div>

<script type="text/javascript">
    let meets = {!! json_encode($meet) !!}

    function inhabilitar() {
        var currentDate = moment().format('YYYY-MM-DD');
        var currentTime = moment().format('H:mm:ss');
        var createTime = meets.meet_time;

        console.log(createTime);

        var dateMeet = moment(meets.meet_date).format('YYYY-MM-DD');
        var timeMeet = moment(meets.meet_time).format('H:mm:ss');

        //diferencia de horas
        var diff = parseInt(timeMeet) - parseInt(currentTime);

        console.log(diff);

        //si la variable createTime viene vacia los input se habilitan
        if(createTime == undefined){
            //
        }else if (dateMeet > currentDate) {
            document.getElementById('document_owner').readOnly = true;
            document.getElementById('name').readOnly = true;
            document.getElementById('last_name').readOnly = true;
            document.getElementById('pet_name').readOnly = true;

        //si la fecha de la cita es igual a la actual y la diferencia de horas es mayor a 
        //2, se puede editar los input fecha y hora
        } else if (dateMeet == currentDate && diff > 2) {
            document.getElementById('document_owner').readOnly = true;
            document.getElementById('name').readOnly = true;
            document.getElementById('last_name').readOnly = true;
            document.getElementById('pet_name').readOnly = true;

        } else {
            document.getElementById('document_owner').readOnly = true;
            document.getElementById('name').readOnly = true;
            document.getElementById('last_name').readOnly = true;
            document.getElementById('pet_name').readOnly = true;
            document.getElementById('meet_date').setAttribute('max', currentDate);
            document.getElementById('meet_date').setAttribute('min', currentDate);
            document.getElementById('meet_time').readOnly = true;

        }

    }

    $(document).ready(function() {
        inhabilitar();
    });
</script>
