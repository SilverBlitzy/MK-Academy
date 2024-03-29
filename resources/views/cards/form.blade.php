
<div class="row">

    <div class="form-group col-sm-6 mt-2">
        <label for="identifier" class="required">Identificador: </label>
        <input type="text" name="identifier" id="identifier" class="form-control" required autofocus value="{{ old('identifier',$card->identifier) }}">
    </div>

    <div class="form-group col-sm-12 col-md-6">
        <label for="client_id">Aluno: </label>
        <select class="select2 select-style" id="client" name="client_id" data-width="100%" value="{{ old('client_id',$card->client->id ?? null) }}">
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
        </select>
        @error('client_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        @error('client_id.*')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group col-sm-12 col-md-6">
        <label for="personal_id">Professor: </label>
        <select class="select2 select-style" id="personal" name="personal_id" data-width="100%" value="{{ old('personal_id', $card->personal->id ?? null) }}">
            @foreach($personals as $personal)
                <option value="{{ $personal->id }}">{{ $personal->name }}</option>
            @endforeach
        </select>
        @error('personal_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        @error('personal_id.*')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group col-sm-12 col-md-6">
        <label for="exercise">Exercícios: </label>
        {{-- @dd($card->exercises) --}}
        <select class="select2 mutiple" id="exercise" multiple name="exercise_id[]" data-width="100%" value="{{ json_encode(old('exercise_id',$card->exercises != null ? $card->exercises->pluck('id') : "" )) }}">
            @foreach($exercises as $exercise)
                <option value="{{ $exercise->id }}">{{ $exercise->name }} - {{ $exercise->seriesNumber }}x{{ $exercise->repetitionNumber }}</option>
            @endforeach
        </select>
        @error('exercise_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        @error('exercise_id.*')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
           $.fn.select2.defaults.set("theme", "classic");
           $('.select2').select2();
        });
        $('.mutiple[value]').each(function() {
             var value = $(this).attr('value');
             if (value) {
                 value = JSON.parse(value);
             }
             $(this).val(value);
         });
        </script>
@endpush
