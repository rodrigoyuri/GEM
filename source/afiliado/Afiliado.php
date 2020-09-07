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

        //$query = parent::select()->from("afiliado")->where("cd_afiliado = ?", [$id])->execute("fetch");

        $query->estado = "RJ";
        $query->cidade = "Rio de Janeiro";
        $query->bairro = "Copacabana";
        $query->cep = "111222333";

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

        $queryFilter = parent::select("cd_afiliado, nm_afiliado, nm_tipo_afiliado, nm_area_interesse, dt_nascimento, cd_telefone ")
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
                                                  cd_contato,
                                                  nm_convenio_medico,
                                                  cd_cpf,
                                                  dt_nascimento,
                                                  nm_diagnostico,
                                                  nm_email,
                                                  nm_endereco,
                                                  nm_area_interesse,
                                                  nm_nacionalidade,
                                                  nm_afiliado,
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
}


/**
 * {"cd_afiliado":"46","nm_afiliado":"Rodrigo Yuri Veloso","cd_rg":"54.542.431-4","cd_cpf":"37777373056","nm_nacionalidade":"Brasileira ","ic_sexo":"Feminino","dt_nascimento":"2020-09-18","nm_endereco":"Douglas Douglas\/AP 11108-109","cd_telefone":"(13) 8912-3719","cd_contato":"(13) 29837-1982","nm_email":"mail@mail.com","nm_escolaridade":"Superior","nm_situacao_profissional":"Estudante","nm_tipo_afiliado":"Volunt\u00e1rio","nm_area_interesse":"Desenvolvimento","nm_disponibilidade":" ; Segunda ; Ter\u00e7a ; Quarta ; Quinta","nm_diagnostico":"","nm_cirurgia_mama_direita":"0","dt_cirugia_mama_direita":"0000-00-00","nm_cirurgia_mama_esquerda":"0","dt_cirugia_mama_esquerda":"0000-00-00","nm_convenio_medico":"","nm_status_assistida":"0000-00-00","nm_status_voluntario":"1"}
 */

// "cd_afiliado as cod, nm_afiliado as nome, cd_rg as rg, cd_cpf as cpf,
//   nm_nacionalidade as nacionalidade, ic_sexo as sexo, dt_nascimento as nascimento,
//   nm_endereco as endereco, cd_telefone as telefone,cd_contato as celular, nm_email as email,
//   nm_situacao_profissional qualificacao , nm_tipo_afiliado as tipo, nm_area_interesse as funcao,
//   nm_disponibilidade as week, nm_diagnostico as diagnostico,
//   nm_cirurgia_mama_direita as mamaDireita, dt_cirugia_mama_direita as anoDireita,
//   nm_cirurgia_mama_esquerda as mamaEsquerda,dt_cirugia_mama_esquerda as anoEsquerda,
//   nm_convenio_medico as convenio, nm_status_assistida as statusAss, nm_status_voluntario as statusVol";
