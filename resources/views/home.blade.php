@extends('layouts.app')

@push('script')
    <script type="text/javascript">
        $(document).ready(function ($) {
            $('.date').mask('00/00/0000');
            $('.time').mask('00:00:00');
            $('.date_time').mask('00/00/0000 00:00:00');
            $('.cep').mask('00000-000');
            $('.phone').mask('0000-0000');
            $('.phone_with_ddd').mask('(00) 00000-0000');
            $('.phone_us').mask('(000) 000-0000');
            $('.mixed').mask('AAA 000-S0S');
            $('#cpf').mask('000.000.000-00', {reverse: true});
            $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
            $('.money').mask('000.000.000.000.000,00', {reverse: true});
            $('.money2').mask("#.##0,00", {reverse: true});
            $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
                translation: {
                    'Z': {
                        pattern: /[0-9]/, optional: true
                    }
                }
            });
            $('.ip_address').mask('099.099.099.099');
            $('.percent').mask('##0,00%', {reverse: true});
            $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
            $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
            $('.fallback').mask("00r00r0000", {
                translation: {
                    'r': {
                        pattern: /[\/]/,
                        fallback: '/'
                    },
                    placeholder: "__/__/____"
                }
            });
            $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
        });

        function validateDate(id) {
            console.log(id);
            var RegExPattern = /^((((0?[1-9]|[12]\d|3[01])[\.\-\/](0?[13578]|1[02])      [\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|[12]\d|31)[\.\-\/](0?[13456789]|1[012])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|1\d|2[0-8])[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|(29[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00)))|(((0[1-9]|[12]\d|3[01])(0[13578]|1[02])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|[12]\d|31)(0[13456789]|1[012])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|1\d|2[0-8])02((1[6-9]|[2-9]\d)?\d{2}))|(2902((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00))))$/;
            if (!((id.match(RegExPattern)) && (id.value!=''))) {
                document.getElementById('msg-erro').style.display = "block";
                document.getElementById('birthday').style.border = '2px solid #f56954';
                document.getElementById('birthday').value = "";
            }
            else
            {
                document.getElementById('msg-erro').style.display = "none";
                document.getElementById('birthday').style.border = '2px solid #00FA9A';
            }
        }
    </script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            @if($user->is_admin == 1)
                <div class="col-md-12">
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#cadastro"><b>Novo funcionário</b></button>
                </div>
                <br><br><br>
        @endif

        <!-- Modal -->
            <div class="modal fade" id="cadastro" tabindex="-1" role="dialog" aria-labelledby="cadastroLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Novo funcionário</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" @if($errors->has('name')) style="color: #f56954" @endif>Nome</label>
                                            <input type="text" class="form-control" id="name" placeholder="Nome" name="name" value="{{old('name')}}" @if($errors->has('name')) style="border:1px solid #f56954" @endif>
                                        </div>
                                        @foreach($errors->get('name') as $error)
                                            <p style="color: #f56954">{{ $error }}</p>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" @if($errors->has('email')) style="color: #f56954" @endif>E-mail</label>
                                            <input type="text" class="form-control" id="email" placeholder="E-mail" name="email" value="{{old('email')}}" @if($errors->has('email')) style="border:1px solid #f56954" @endif>
                                        </div>
                                        @foreach($errors->get('email') as $error)
                                            <p style="color: #f56954">{{ $error }}</p>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="function_description" @if($errors->has('function_description')) style="color: #f56954" @endif>Funções</label>
                                            <input type="text" class="form-control" id="function_description" placeholder="Funções" name="function_description" value="{{old('function_description')}}" @if($errors->has('function_description')) style="border:1px solid #f56954" @endif>
                                        </div>
                                        @foreach($errors->get('function_description') as $error)
                                            <p style="color: #f56954">{{ $error }}</p>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="login" @if($errors->has('login')) style="color: #f56954" @endif>Login</label>
                                            <input type="text" class="form-control" id="login" placeholder="Login" name="login" value="{{old('login')}}" @if($errors->has('login')) style="border:1px solid #f56954" @endif>
                                        </div>
                                        @foreach($errors->get('login') as $error)
                                            <p style="color: #f56954">{{ $error }}</p>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="birthday" @if($errors->has('birthday')) style="color: #f56954" @endif>Data de nascimento</label>
                                            <input type="text" class="form-control date" id="birthday" placeholder="Data de nascimento" name="birthday" value="{{old('birthday')}}" @if($errors->has('birthday')) style="border:1px solid #f56954" @endif onchange="validateDate(this.value)">
                                        </div>
                                        <div id="msg-erro" style="display: none;">
                                            <p style="color: #f56954">Data inválida.</p>
                                        </div>
                                        @foreach($errors->get('birthday') as $error)
                                            <p style="color: #f56954">{{ $error }}</p>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="salary" @if($errors->has('salary')) style="color: #f56954" @endif>Salário</label>
                                            <input type="text" class="form-control money" id="salary" placeholder="Salário" name="salary" value="{{old('salary')}}" @if($errors->has('salary')) style="border:1px solid #f56954" @endif maxlength="11">
                                        </div>
                                        @foreach($errors->get('salary') as $error)
                                            <p style="color: #f56954">{{ $error }}</p>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <div class="col-md-6">
                    <label for="filtro">Pesquisa por nome</label>
                    <input type="text" class="form-control" id="filtro" name="filtro"><br>
                    <button type="submit" class="btn btn-success">Buscar</button>
                </div>
            </form>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Descrição da função</th>
                        <th scope="col">Login</th>
                        <th scope="col">Data de nascimento</th>
                        @if($user->is_admin == 1)
                            <th scope="col">Salário</th>
                        @endif
                        <th scope="col">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $u)
                        <tr>
                            <th scope="row">{{ $u->id }}</th>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->function_description }}</td>
                            <td>{{ $u->login }}</td>
                            <td>{{ $u->birthday }}</td>
                            @if($user->is_admin == 1)
                                <td>{{ $u->salary }}</td>
                            @endif
                            <td>
                                <button class="btn btn-xs btn-primary" type="button" data-toggle="modal" data-target="#editar-{{ $u->id }}"><b>Editar</b></button> -
                                <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#excluir-{{ $u->id }}"><b>Excluir</b></button>

                                <div class="modal fade" id="editar-{{ $u->id }}" tabindex="-1" role="dialog" aria-labelledby="editarLabel-{{ $u->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Editar funcionário</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('edit', ['id' => $u->id]) }}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name" @if($errors->has('name')) style="color: #f56954" @endif>Nome</label>
                                                                <input type="text" class="form-control" id="name" placeholder="Nome" name="name" value="{{ $u->name }}" @if($errors->has('name')) style="border:1px solid #f56954" @endif>
                                                            </div>
                                                            @foreach($errors->get('name') as $error)
                                                                <p style="color: #f56954">{{ $error }}</p>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email" @if($errors->has('email')) style="color: #f56954" @endif>E-mail</label>
                                                                <input type="text" class="form-control" id="email" placeholder="E-mail" name="email" value="{{ $u->email }}" @if($errors->has('email')) style="border:1px solid #f56954" @endif>
                                                            </div>
                                                            @foreach($errors->get('email') as $error)
                                                                <p style="color: #f56954">{{ $error }}</p>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="function_description" @if($errors->has('function_description')) style="color: #f56954" @endif>Funções</label>
                                                                <input type="text" class="form-control" id="function_description" placeholder="Funções" name="function_description" value="{{ $u->function_description }}" @if($errors->has('function_description')) style="border:1px solid #f56954" @endif>
                                                            </div>
                                                            @foreach($errors->get('function_description') as $error)
                                                                <p style="color: #f56954">{{ $error }}</p>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="login" @if($errors->has('login')) style="color: #f56954" @endif>Login</label>
                                                                <input type="text" class="form-control" id="login" placeholder="Login" name="login" value="{{ $u->login }}" @if($errors->has('login')) style="border:1px solid #f56954" @endif>
                                                            </div>
                                                            @foreach($errors->get('login') as $error)
                                                                <p style="color: #f56954">{{ $error }}</p>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="birthday" @if($errors->has('birthday')) style="color: #f56954" @endif>Data de nascimento</label>
                                                                <input type="text" class="form-control date" id="birthday" placeholder="Data de nascimento" name="birthday" value="{{ $u->birthday }}" @if($errors->has('birthday')) style="border:1px solid #f56954" @endif>
                                                            </div>
                                                            @foreach($errors->get('birthday') as $error)
                                                                <p style="color: #f56954">{{ $error }}</p>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="salary" @if($errors->has('salary')) style="color: #f56954" @endif>Salário</label>
                                                                <input type="text" class="form-control money" id="salary" placeholder="Salário" name="salary" value="{{ $u->salary }}" @if($errors->has('salary')) style="border:1px solid #f56954" @endif maxlength="11">
                                                            </div>
                                                            @foreach($errors->get('salary') as $error)
                                                                <p style="color: #f56954">{{ $error }}</p>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                                                        <button type="submit" class="btn btn-primary">Editar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="excluir-{{ $u->id }}" tabindex="-1" role="dialog" aria-labelledby="excluirLabel-{{ $u->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Excluir funcionário</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <p>Tem certeza que deseja excluir o fundcionário {{ $u->name }}?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                    <form action="{{ route('delete', ['id' => $u->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">Confirmar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
        @stack('script')
    </div>
@endsection
