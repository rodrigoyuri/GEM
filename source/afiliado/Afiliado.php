<?php

namespace Source\Models;


use Source\Crud\Crud;

class Afiliado extends Crud
{

    public function showAffiliate(int $id)
    {
        $query = parent::select("cd_afiliado as cod, nm_afiliado as nome, cd_rg as rg, cd_cpf as cpf,
                                nm_nacionalidade as nacionalidade, ic_sexo as sexo, dt_nascimento as data,
                                nm_endereco as endereco, cd_telefone as telefone,cd_contato as celular, nm_email as email,
                                nm_situacao_profissional qualificacao , nm_tipo_afiliado as tipo, nm_area_interesse as funcao,
                                nm_disponibilidade as week, nm_diagnostico as diagnostico,
                                nm_cirurgia_mama_direita as mamaDireita, dt_cirugia_mama_direita as anoDireita,
                                nm_cirurgia_mama_esquerda as mamaEsquerda,dt_cirugia_mama_esquerda as anoEsquerda,
                                nm_convenio_medico as convenio, nm_status_assistida as statusAss, nm_status_voluntario as statusVol")
            ->from("afiliado")->where("cd_afiliado = ?", [$id])->execute("fetch");

        $endereco = explode(";", $query->endereco);
        $query->estado = (isset($endereco[0])) ? $endereco[0] : null;
        $query->cidade = (isset($endereco[1])) ? $endereco[1] : null;
        $query->bairro = (isset($endereco[2])) ? $endereco[2] : null;
        $query->cep = (isset($endereco[3])) ? $endereco[3] : null;
        // Deixo tudo em minusculo, removo espaços em branco e separo em um array pelo ;
        $query->week = explode(";", str_replace(" ", "", strtolower($query->week)));

        unset($query->endereco);

        return $query;
    }

    public function indexFilter($data = array())
    {
        $columns = array(
            "0" => "nm_afiliado",
            "1" => "nm_tipo_afiliado",
            "2" => "dt_nascimento",
            "3" => "cd_telefone",
        );

        $orderBy = "{$columns[$data['order'][0]['column']]}";
        $typeOrderBy = $data['order'][0]['dir'];
        $start = $data['start'];
        $end = $data['length'];

        $queryFilter = parent::select("cd_afiliado, nm_afiliado, nm_tipo_afiliado, nm_area_interesse, dt_nascimento, cd_telefone, CONCAT(nm_tipo_afiliado,';',COALESCE(nm_status_voluntario,'-'), ';', COALESCE(nm_status_assistida, '-')) as status ")
            ->from("afiliado");

        if (!empty($data["search"]['value'])) {
            $queryFilter = $queryFilter
                ->where("nm_afiliado LIKE (?)", ["%{$data["search"]['value']}%"]);
        }

        $totalRegisterInQuery = $queryFilter->execute("rowCount", false);

        $query = $queryFilter
            ->order($orderBy, $typeOrderBy)
            ->limit($start, $end)
            ->execute("fetchAll");

        $totalRegisterInTable = parent::select("COUNT(*) as count")
            ->from("afiliado")
            ->execute("fetch")
            ->count;

        $jsonData = array(
            "draw" => intval($data["draw"]),
            "recordsTotal" => intval($totalRegisterInTable),
            "recordsFiltered" => intval($totalRegisterInQuery),
            "data" => $query
        );

        return $jsonData;
    }

    public function insertAffiliate($data)
    {
        $crud = $this->insert("afiliado", $data, "dt_cirugia_mama_direita, 
                                                  dt_cirugia_mama_esquerda,
                                                  nm_status_assistida,
                                                  cd_contato,
                                                  nm_convenio_medico,
                                                  cd_cpf,
                                                  dt_nascimento,
                                                  nm_diagnostico,
                                                  nm_email,
                                                  nm_endereco,
                                                  nm_area_interesse,
                                                  nm_cirurgia_mama_direita,
                                                  nm_cirurgia_mama_esquerda,
                                                  nm_nacionalidade,
                                                  nm_afiliado,
                                                  nm_situacao_profissional,
                                                  cd_rg,
                                                  ic_sexo,
                                                  cd_telefone,
                                                  nm_tipo_afiliado,
                                                  nm_disponibilidade")->execute();
        if ($crud) {
            return "Cadastrado Com Sucesso";
        } else {
            return $this->getError();
        }
    }

    public function updateAffiliate(int $id, array $data)
    {
        $crud = $this->update("afiliado", "dt_cirugia_mama_direita = ?, 
                                            dt_cirugia_mama_esquerda = ?,
                                            nm_status_assistida = ?,
                                            cd_contato = ?,
                                            nm_convenio_medico = ?,
                                            cd_cpf = ?,
                                            dt_nascimento = ?,
                                            nm_diagnostico = ?,
                                            nm_email = ?,
                                            nm_endereco = ?,
                                            nm_area_interesse = ?,
                                            nm_cirurgia_mama_direita = ?,
                                            nm_cirurgia_mama_esquerda = ?,
                                            nm_nacionalidade = ?,
                                            nm_afiliado = ?,
                                            nm_situacao_profissional = ?,
                                            cd_rg = ?,
                                            ic_sexo = ?,
                                            cd_telefone = ?,
                                            nm_tipo_afiliado = ?,
                                            nm_disponibilidade = ?", $data)
            ->where("cd_afiliado = ?", [$id])->execute();

        if ($crud) {
            return "Atualizado Com Sucesso";
        } else {
            return "não";
            return $this->getError();
        }
    }
}


// "cd_afiliado as cod, nm_afiliado as nome, cd_rg as rg, cd_cpf as cpf,
//   nm_nacionalidade as nacionalidade, ic_sexo as sexo, dt_nascimento as nascimento,
//   nm_endereco as endereco, cd_telefone as telefone,cd_contato as celular, nm_email as email,
//   nm_situacao_profissional qualificacao , nm_tipo_afiliado as tipo, nm_area_interesse as funcao,
//   nm_disponibilidade as week, nm_diagnostico as diagnostico,
//   nm_cirurgia_mama_direita as mamaDireita, dt_cirugia_mama_direita as anoDireita,
//   nm_cirurgia_mama_esquerda as mamaEsquerda,dt_cirugia_mama_esquerda as anoEsquerda,
//   nm_convenio_medico as convenio, nm_status_assistida as statusAss, nm_status_voluntario as statusVol";
