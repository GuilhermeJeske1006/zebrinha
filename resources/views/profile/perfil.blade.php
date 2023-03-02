<!-- breadcrumb -->
@extends('components.body')
@section('body')
    @component('components.topWhite', ['carrinho' => $carrinho])
    @endcomponent
    <div class="container" style="margin-bottom: 3%">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('index') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Meu perfil
            </span>
        </div>
    </div>

    <section >

            <div class="col-lg-10 col-xl-12 m-lr-auto m-b-50" style="background: #f3f4f6;">

        <div class="container" style="padding-top: 4rem">
            <div class="row">
            <div class="col-12 col-md-12 d-flex">
                <div class="col-6 col-md-6">
                    <div class="container">
                        <h3>Dados do perfil</h3>
                        <span>
                            Atualize as informações de perfil e o endereço de e-mail da sua conta.
                        </span>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="card" style="border-radius: 8px;">
                        <div class="card-body">
                            <form method="POST" action="{{route('edit_perfil')}}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{auth()->user()->id}}" >

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="name" value="{{$usuario->name}}"  id="name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" value="{{$usuario->email}}" class="form-control" id="email" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12 col-md-12 d-flex" style="
    flex-direction: row-reverse;">
                                            <button type="submit" class="btn btn-dark"  style="border-radius: 8px">Salvar</button>

                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            </div>
        </div>
                <div class="container" style="margin-top: 5%">
                    <div class="row">
                        <div class="col-12 col-md-12 d-flex">
                            <div class="col-6 col-md-6">
                                <div>
                                    <h3>Atualizar senha</h3>
                                    <span>Certifique-se de que sua conta esteja usando uma senha forte e aleatória para se manter segura.</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <form action="updatePassword" method="POST" class="card" style="border-radius: 8px;">
                                    @csrf
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Senha atual</label>
                                            <input type="password" class="form-control" id="current_password" autocomplete="current-password" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nova senha</label>
                                            <input type="password" wire:model.defer="state.password" autocomplete="new-password" class="form-control" id="password" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nova senha</label>
                                            <input type="password"  class="form-control" id="password_confirmation"  wire:model.defer="state.password_confirmation" autocomplete="new-password" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-12 col-md-12 d-flex" style="
    flex-direction: row-reverse;">
                                                    <button type="submit" class="btn btn-dark"  style="border-radius: 8px">Salvar</button>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container" style="margin-top: 5%">
                    <div class="row">
                        <div class="col-12 col-md-12 d-flex">
                            <div class="col-6 col-md-6">
                                <div>
                                    <h3>Deletar sua conta</h3>
                                    <span>Delete permanemtemente a sua conta</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="card" style="border-radius: 8px;">
                                    <div class="card-body">
                                        <div class="mb-3">
                                              Depois que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente.
                                        </div>

                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-12 col-md-12 d-flex" style="
    flex-direction: row-reverse;">
                                                    <button type="submit" class="btn btn-danger"  style="border-radius: 8px">Excluir conta</button>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
