<div class="row">
    <div class="form-group col-sm-6 mt-2">
        <label for="name" class="required">Nome </label>
        <input type="text" name="name" id="name" class="form-control" required autofocus value="{{ old('name',$client->name)}}">
    </div>

    <div class="form-group col-sm-6 mt-2">
        <label for="number" class="required">Celular</label>
        <input type="phone" name="number" id="number" class="form-control" required  value="{{ old('number', $client->number )}}">
    </div>

    <div class="form-group col-sm-6 mt-2">
        <label for="email" class="required">Email</label>
        <input type="email" name="email" id="email" class="form-control" required value="{{ old('email', $client->email)}}">
    </div>

    <div class="form-group col-sm-6 mt-2">
        <label for="birth_date" class="required">Data de Nascimento </label>
        <input type="date" name="birth_date" id="birth_date" class="form-control" required value="{{ old('birth_date', $client->birth_date)}}">
    </div>

    <div class="form-group col-sm-6 mt-2">
        <label for="cpf" class="required">CPF </label>
        <input type="text" name="cpf" id="cpf" class="form-control" required value="{{ old('cpf', $client->cpf)}}">
    </div>

    <div class="form-group col-sm-6 mt-2">
        <label for="registration_date" class="required">Data de Matricula</label>
        <input type="date" name="registration_date" id="registration_date" class="form-control" required value="{{ old('registration_date', $client->registration_date)}}">
    </div>

    @if($create)
        <div class="form-group col-sm-6 mt-2">
            <label for="password">Senha</label> 
            <div class="input-group">
                <div class="input-group-append" id="visible">
                    <span class="input-group-text rounded-left border-right-0" id="span">
                        <i class="fa fa-eye-slash" id="icon"></i>
                    </span> 
                </div>    
                <input autocomplete="new-password" type="password" class="senhaID form-control" name="password" id="password">
            </div>
        </div>
        <div class="form-group col-sm-6 mt-2">
            <label for="password">Confirme sua senha</label>
            <input autocomplete="new-password" type="password" class="senhaID form-control" name="password_confirmation" id="password">
        </div>
    @endif

    <div class="form-group col-sm-6 mt-2">
        <label for="image" class="required">imagem</label>
        @if($show)
            <img src="{{ asset("img/profilePic/" . $client->picture ) }}" alt="Imagem do cliente" class="img-thumbnail">
        @endif

        @if($create)
            <input type="file" accept="image/*" class="form-control-file" name="image">
        @endif
    </div>




</div>

@push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

    <script>
        
        //VISUALIZAÇÃO DE SENHA
        $(document).ready(function(){
            $('#visible').click(function(){
                if($('#password').attr('type') == 'password'){
                    $('#password').attr('type', 'text');
                    $('#icon').removeClass('fa-eye-slash');
                    $('#icon').addClass('fa-eye');
                }else{
                    $('#password').attr('type', 'password');
                    $('#icon').removeClass('fa-eye');
                    $('#icon').addClass('fa-eye-slash');
                }
            });
        });

        //MASCARA DE CPF
        $(document).ready(function(){
            $('#cpf').mask('000.000.000-00', {reverse: true});
        });

        //MASCARA DE TELEFONE
        $(document).ready(function(){
            $('#number').mask('(00) 00000-0000');
        });
    </script>
@endpush