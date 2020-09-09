<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"> -->

    <link rel="stylesheet" href="<?= URL_BASE ?>/source/global/css/menu.css">

    <link rel="stylesheet" href="<?= URL_BASE ?>/source/global/css/global.css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/source/afiliado/view/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <title>Lista Geral </title>
</head>

<body>


    <div class="container">
        <?php include __DIR__ . "/../../global/components/header.php" ?>
        <table id="list-afiliados" class="display" style="width: 100%;">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo Afiliado</th>
                    <th>Função</th>
                    <th>Status</th>
                    <th><i class="fas fa-birthday-cake"></i></th>
                    <th><i class="fas fa-phone"></i></th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>Tipo Afiliado</th>
                    <th>Função</th>
                    <th>Status</th>
                    <th><i class="fas fa-birthday-cake"></i></th>
                    <th><i class="fas fa-phone"></i></th>
                    <th>Opções</th>
                </tr>
            </tfoot>
        </table>
    </div>


    <div id="modal-ver" class="modal-container modal-hidden" close="modal-ver">
        <div class="modal">
            <div class="modal-header">
                <button id="modal-edit-affiliate" class="input-base input-item-btn">Editar</button>
                <button id="modal-salve-affiliate" class="input-base" hidden>Salvar</button>
                <p id="modal-text-type">Afiliado</p>
                <span close="modal-ver"><i class="fas fa-times"></i></span>
            </div>
            <div class="modal-body">
                <nav class="modal-menu">
                    <span class="modal-menu-item menu-item-actived" modal-view="dados-pessoais">Dados Pessoais</span>
                    <span class="modal-menu-item" modal-view="dados-contatos">Dados Contato</span>
                    <span class="modal-menu-item" modal-view="dados-afiliados">Dados Afiliado</span>
                    <span class="modal-menu-item" modal-view="dados-cedidos">Benficios cedidos</span>
                </nav>
                <div class="dados form-outer">
                    <input type="text" name="codAfiliado" id="codAfiliado" hidden>
                    <form id="form-affiliate" action="<?= URL_BASE ?>/admin/cadastro-afiliado" method="POST">
                        <section id="dados-pessoais" class="page">
                            <div class="title">Informações pessoais:</div>
                            <div class="field">
                                <div class="label">Nome Completo</div>
                                <input type="text" class="input-base" name="nome" id="nome" title="nome" />
                            </div>
                            <div class="field">
                                <div class="label">RG</div>
                                <input type="text" class="input-base" name="rg" id="rg" title="rg" maxlength="9" />
                            </div>
                            <div class="field">
                                <div class="label">CPF</div>
                                <input type="text" class="input-base" name="cpf" id="cpf" title="CPF" maxlength="14" />
                            </div>
                            <div class="field">
                                <div class="label">Nacionalidade</div>
                                <input type="text" class="input-base" name="nacionalidade" id="nacionalidade" title="Nacionalidade">
                            </div>
                            <div class="field">
                                <div class="label">Data de nascimento</div>
                                <input type="date" class="input-base" name="data" id="data" title="Data de Nascimento">
                            </div>
                            <div class="field">
                                <button class="firstNext next" modal-view="dados-contatos">Próximo</button>
                            </div>
                        </section>
                        <section id="dados-contatos" class="page modal-hidden">
                            <div class="title">Informações de contato:</div>
                            <div class="field">
                                <div class="label">Estado</div>
                                <select class="input-base" name="estado" id="estado" title="Estado">
                                    <option class="" value="Estado">
                                        Estado
                                    </option>
                                    <option class="" value="AC">
                                        Acre
                                    </option>
                                    <option class="" value="AL">
                                        Alagoas
                                    </option>
                                    <option class="" value="AP">
                                        Amapá
                                    </option>
                                    <option class="" value="AM">
                                        Amazonas
                                    </option>
                                    <option class="" value="BA">
                                        Bahia
                                    </option>
                                    <option class="" value="CE">
                                        Ceará
                                    </option>
                                    <option class="" value="DF">
                                        Distrito Federal
                                    </option>
                                    <option class="" value="ES">
                                        Espírito Santo
                                    </option>
                                    <option class="" value="GO">
                                        Goiás
                                    </option>
                                    <option class="" value="MA">
                                        Maranhão
                                    </option>
                                    <option class="" value="MT">
                                        Mato Grosso
                                    </option>
                                    <option class="" value="MS">
                                        Mato Grosso do Sul
                                    </option>
                                    <option class="" value="MG">
                                        Minas Gerais
                                    </option>
                                    <option class="" value="PA">
                                        Pará
                                    </option>
                                    <option class="" value="PB">
                                        Paraíba
                                    </option>
                                    <option class="" value="PR">
                                        Paraná
                                    </option>
                                    <option class="" value="PE">
                                        Pernambuco
                                    </option>
                                    <option class="" value="PI">
                                        Piauí
                                    </option>
                                    <option class="" value="RJ">
                                        Rio de Janeiro
                                    </option>
                                    <option class="" value="RN">
                                        Rio Grande do Norte
                                    </option>
                                    <option class="" value="RS">
                                        Rio Grande do Sul
                                    </option>
                                    <option class="" value="RO">
                                        Rondônia
                                    </option>
                                    <option class="" value="RR">
                                        Roraima
                                    </option>
                                    <option class="" value="SC">
                                        Santa Catarina
                                    </option>
                                    <option class="" value="SP">
                                        São Paulo
                                    </option>
                                    <option class="" value="SE">
                                        Sergipe
                                    </option>
                                    <option class="" value="TO">
                                        Tocantins
                                    </option>
                                </select>
                            </div>
                            <div class="field">
                                <div class="label">Cidade</div>
                                <input type="text" class="input-base" name="cidade" id="cidade" title="Cidade">
                            </div>
                            <div class="field">
                                <div class="label">Bairro</div>
                                <input type="text" class="input-base" name="bairro" id="bairro" title="Bairro">
                            </div>
                            <div class="field">
                                <div class="label">CEP</div>
                                <input type="text" class="input-base" name="cep" id="cep" title="CEP">
                            </div>
                            <div class="field">
                                <div class="label">Telefone</div>
                                <input type="text" class="input-base" name="telefone" id="telefone" placeholder="(00)0000-0000" title="Telefone Princial">
                            </div>
                            <div class="field">
                                <div class="label">Celular</div>
                                <input type="text" class="input-base" name="celular" id="celular" placeholder="(00)00000-0000" title="Telefone para contato">
                            </div>
                            <div class="field">
                                <div class="label">Email</div>
                                <input type="email" class="input-base" name="email" id="email" placeholder="exemplo@gmail.com" title="E-mail">
                            </div>
                            <div class="field btns">
                                <button class="prev-1 prev" modal-view="dados-pessoais">Anterior</button>
                                <button class="next-1 next" modal-view="dados-afiliados">Próximo</button>
                            </div>
                        </section>
                        <section id="dados-afiliados" class="page modal-hidden">
                            <div class="title">Outras informações:</div>
                            <div class="field">
                                <div class="label">Sexo</div>
                                <select name="sexo" class="input-base">
                                    <option value="Feminino">Feminino</option>
                                    <option value="Masculino">Masculino</option>
                                </select>
                            </div>
                            <div class="field">
                                <div class="label">Tipo</div>
                                <select id="ddlPassport" name="tipo" class="input-base">
                                    <option value="Assistida">Assistida</option>
                                    <option value="Voluntário">Voluntário</option>
                                </select>
                            </div>
                            <div id="voluntario">
                                <div class="field">
                                    <div class="label">Area de interesse</div>
                                    <input type="text" name="funcao" class="input-base">
                                </div>
                                <div class="field">
                                    <div class="label">Qualificação Profissional</div>
                                    <input type="text" name="qualificacao" class="input-base">
                                </div>

                                <div class="fielda">
                                    <div class="label">Disponibilidade</div>
                                    <div class="todas">
                                        <div class="div">
                                            <input type="checkbox" name="week[]" value="segunda">
                                            <label for="">Segunda</label>
                                        </div>
                                        <div class="div">
                                            <input type="checkbox" name="week[]" value="terça">
                                            <label for="">Terça</label>
                                        </div>
                                        <div class="div">
                                            <input type="checkbox" name="week[]" value="quarta">
                                            <label for="">Quarta</label>
                                        </div>
                                        <div class="div">
                                            <input type="checkbox" name="week[]" value="quinta">
                                            <label for="">Quinta</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="assistida">
                                <div class="field">
                                    <div class="label">Diagnóstico</div>
                                    <textarea name="diagnostico" id="diagnostico" cols="30" rows="10" class="input-base"></textarea>
                                </div>

                                <div class="field">
                                    <div class="label">Auta Hospitalar</div>
                                    <input type="date" name="auta" class="input-base" id="auta">
                                </div>

                                <div class="fielda">
                                    <div class="label">Cirurgia da mama</div>
                                    <div>
                                        <div class="field label-mama-direita">
                                            <input type="checkbox" class="custom-control-input" name="mamaDireita" id="mamaDireita" value="1">
                                            <label class="custom-control-label" for="mamaDireita">Direita</label>
                                        </div>
                                        <div class="data-mama-direita">
                                            <input type="date" name="anoDireita" class="input-base" id="anoDireita">
                                        </div>

                                        <div class="field label-mama-direita">
                                            <input type="checkbox" class="custom-control-input" name="mamaEsquerda" id="mamaEsquerda" value="1">
                                            <label class="custom-control-label" for="mamaEsquerda">Esquerda</label>
                                        </div>
                                        <div class="data-mama-direita">
                                            <input type="date" name="anoEsquerda" class="input-base" id="anoEsquerda">
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="label">Convenio</div>
                                    <textarea name="convenio" cols="30" rows="10" class="input-base"></textarea>
                                </div>
                            </div>
                            <div class="field btns">
                                <button class="prev-2 prev" modal-view="dados-contatos">Anterior</button>
                                <button class="submit" id="enviar">Enviar</button>
                            </div>
                        </section>
                    </form>
                    <section id="dados-cedidos" class="page modal-hidden">
                        <form action="<?= URL_BASE ?>/admin/cadastro-item" id="form-items">
                            <input type="number" name="qtItem" id="" class="input-base input-item-num">
                            <input type="text" name="nomeItem" class="input-base input-item">
                            <button type="submit" class="input-base input-item-btn"><i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </form>
                        <table id="list-items" class="table-item" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Qtd</th>
                                    <th>Nome</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </section>
                </div>

            </div>
            <div class="modal-footer">
                <p>Footer</p>
            </div>
        </div>
    </div>

    <div id="modal-cad-usu" class="modal-container modal-hidden" close="modal-ver">
        <div class="modal">
            <div class="modal-header">
                <p id="modal-text-type">Afiliado</p>
                <span close="modal-ver"><i class="fas fa-times"></i></span>
            </div>
            <div class="modal-body">

                <div class="dados form-outer">
                    <form action="<?= URL_BASE ?>/admin/cadastro-usuario" method="POST">

                        <div class="page">
                            <div class="title">Informações para Cadastro:</div>

                            <div class="field">
                                <div class="label">E-mail</div>
                                <input type="email" class="input-base" name="email" id="email" title="E-mail" />
                            </div>
                            <div class="field">
                                <div class="label">Senha</div>
                                <input type="password" class="input-base" name="senha" id="senha" title="Senha" />
                            </div>
                            <div class="field">
                                <div class="label">Confirmar senha</div>
                                <input type="password" class="input-base" name="confSenha" id="confSenha" title="Confirmar Senha">
                            </div>
                            <div class="field btns">
                                <button class="submit" id="confirmar">Confirmar</button>
                                <button>Cancelar</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <p>Footer</p>
            </div>
        </div>
    </div>


    <script src="<?= URL_BASE ?>/source/global/js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="<?= URL_BASE ?>/source/afiliado/view/js/afiliado.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous">
    </script>
</body>

</html>