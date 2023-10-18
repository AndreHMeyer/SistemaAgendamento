<?php

include "../SistemaAgendamento/bancoDeDados/RepositorioPessoas.php";

$repositorioProfissionais = new \Database\RepositorioPessoas();
$profissionais = $repositorioProfissionais->obterTodasPessoas();

$ies_situacao = "Ativo";
if ($profissionais) {
    foreach ($profissionais as $profissional) {
        $idProfissional = $profissional->getId();
        $nomeCompleto = $profissional->getNome();

        $exploNome = explode(' ', $nomeCompleto);
        $firstLeterName = substr($exploNome[0], 0, 1);
        $firstLeterMidle = substr(end($exploNome), 0, 1);

        if ($idProfissional == 2) {
            $ies_situacao = "Inativo";
        }

        if ($idProfissional == 4) {
            $ies_situacao = "Bloqueado";
        }

        if ($ies_situacao == "Ativo") {
            $situacao = " <span class='situcao ies_ativa'>" . $ies_situacao . "</span>";
        } elseif ($ies_situacao == "Inativo") {
            $situacao = " <span class='situcao ies_inativa'>" . $ies_situacao . "</span>";
        } elseif ($ies_situacao == "Bloqueado") {
            $situacao = " <span class='situcao ies_bloqueada'>" . $ies_situacao . "</span>";
        } else {
            $situacao = " <span class='situcao ies_bloqueada'> Indefinida </span>";
        }


        $agenda[$idProfissional] = array(
            'nome' => $nomeCompleto,
            "iniciais_nome" => $firstLeterName . $firstLeterMidle,
            "email" => $profissional->getEmail(),
            "situcao" => $situacao,
            "ocupacao" => '87% Ocupada',
            "disponibilidade" => '13% Livre',
            "prox_data" => '05/01/2023'

        );
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Remember Med</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="includes/bootstrap-4.0.0/bootstrap-4.0.0/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="includes/icons-main/font/bootstrap-icons.css" />
    <script src="includes/jquery-3.7.1.js"></script>
</head>
<style>
    .search-container {
        display: flex;
        align-items: center;
    }

    .title {
        margin-left: 10px;
    }

    .search-container,
    .title {
        margin-top: 80px;
        margin-left: 80px;
    }

    .add-agenda {
        margin-left: 40px;
        margin-top: 80px;
        background-color: #5272E9;
        color: white;
    }

    .search-container input {
        border: 1px solid #5272E9;
        border-right: none;
    }

    .input-group button {
        border: 1px solid #5272E9;
        background: transparent;
        border-left: none;
    }

    .filtro button {
        border-right: none;
    }

    .input-group button:hover,
    .input-group button:active {
        background-color: #f5f5f5;
    }

    .table-container {
        border-radius: 10px;
        border: 1px solid #D0D0CE;
        margin-left: 80px;
        margin-top: 30px;
        width: 1400px;
        overflow: hidden;
    }

    .cabecalho {
        color: #6A6A65;
        background-color: #F8F8F8;
        border-bottom: none;
        border-radius: 100px;
        border-radius: 10px 10px 0 0;
    }

    .table {
        border-collapse: collapse;
    }

    .icon img {
        width: 16px;
        margin-right: 10px;
        cursor: pointer;
    }

    .info-text {
        font-weight: 600;

    }

    .ocupacao {
        color: #8B7835;
        background-color: #FFE68B;
        border-radius: 50px;
        padding: 5px 10px;
        display: inline-block;
        line-height: 1;
    }

    .disponibilidade {
        color: #3F8B35;
        background-color: #E5F5E4;
        border-radius: 50px;
        margin-left: 10px;
        padding: 5px 10px;
        display: inline-block;
        line-height: 1;

    }

    .iniciais {
        color: #004DEB;
        background-color: #F0F4FF;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
    }

    .situcao {
        border-radius: 50px;
        padding: 1px 9px;
        display: inline-block;
        line-height: 1.4;
    }

    .ies_ativa {
        color: #3F8B35;
        background-color: #E5F5E4;
        font-weight: 600;
    }

    .ies_inativa {
        color: #4E4E4E;
        background-color: #E5F5E4;
        font-weight: 600;
    }

    .ies_bloqueada {
        color: #E61E00;
        background-color: #FFDAD5;
        font-weight: 600;
    }

    .checkProfissional {
        margin-left: 30px;
        margin-right: 0px;
    }
</style>

<body>

    <div id="nav-head">
    </div>
    <div id="nav-lateral">
    </div>


    <div class="d-flex align-items-center">
        <h2 class="title" style="font-weight: bold;">Agendas</h2>
        <div class="search-container">
            <div class="input-group">
                <input type="text" class="form-control search-bar" style="width: 800px;">
                <div class="input-group-append filtro">
                    <button class="btn" type="button">
                        <i class="fas fa-search"><img src="img/icon_filtro.png" alt="Icone filtro pesquisa" style="width: 20px;"></i>
                    </button>
                </div>
                <div class="input-group-append search">
                    <button class="btn" type="button">
                        <i class="fas fa-search"><img src="img/icon_search.png" alt="Icone lopa de pesquisa" style="width: 15px;"></i>
                    </button>
                </div>

            </div>
        </div>
        <button class="btn add-agenda" type="button"> + Adicionar </button>
    </div>

    <div class="table-container">
        <table class="table">
            <thead class="cabecalho">
                <tr>
                    <th scope="col"></th>
                    <th scope="col" class="sortable">Médico <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable">Situação<i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" style="width: 250px;">Ocupação<i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" style="text-align:center;">Próxima data livre</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody style="height: 50px;">
                <?php foreach ($agenda as $key => $value) { ?>
                    <tr>
                        <td style="vertical-align: middle;"><input type="checkbox" class="checkProfissional" id="<?php echo $key; ?>"></td>
                        <td style="display: flex; align-items: center;">
                            <span class="iniciais"><?php echo $value['iniciais_nome']; ?></span>
                            <span style="margin-left: 10px;"><?php echo $value['nome'] . "<br>" . $value['email']; ?><br></span>
                        </td>
                        <td style="vertical-align: middle;"><?php echo $value['situcao']; ?></td>
                        <td class="info-text" style="vertical-align: middle;">
                            <span class="ocupacao"><?php echo $value['ocupacao']; ?></span>
                            <span class="disponibilidade"><?php echo $value['disponibilidade']; ?></span>
                        </td>
                        <td style="vertical-align: middle; text-align:center;"><?php echo $value['prox_data']; ?></td>
                        <td class="icon" style="vertical-align: middle;">
                            <span><img src="img/icon_lapis.png" onclick="editar('<?php echo $key; ?>')"></span>
                            <span><img src="img/icon_lixeira.png" onclick="excluir('<?php echo $key; ?>')"></span>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>





</body>
<script>
    $(function() {
        $("#nav-head").load("navbar_head.html");
    });
    $(function() {
        $("#nav-lateral").load("navbar_lateral.html");
    });

    function editar(id) {
        let id_profissional = id;

        $.ajax({
            url: 'teste.php', // Enviar o id para buscar as informações do profissional para colocar no form
            type: 'POST',
            data: {
                id: id_profissional
            },
            success: function(response) {
                console.log('Info:', response);
                modalEdicao(response);
            },
            error: function(xhr, status, error) {
                console.error('Erro na chamada AJAX:', status, error);
            }
        });
    }
</script>

</html>