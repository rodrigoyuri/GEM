<?php

namespace Source\Models;


use Source\Crud\Crud;

class Afiliado extends Crud
{

    public function showAffiliate(int $id)
    {
        $query = parent::select()->from("afiliado")->where("cd_afiliado = ?", [$id])->execute("fetch");

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

        $queryFilter = parent::select("cd_afiliado, nm_afiliado, nm_tipo_afiliado, dt_nascimento, cd_telefone")
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
        $crud = $this->insert("afiliado", $data, "nm_afiliado, cd_rg, cd_cpf, dt_nascimento, nm_escolaridade, nm_situacao_profissional, 
                            cd_telefone, cd_contato, nm_email, nm_diagnostico, nm_cirurgia_mama_direita, dt_cirugia_mama_direita, 
                            nm_cirurgia_mama_esquerda, dt_cirugia_mama_esquerda, nm_convenio_medico, nm_endereco")->execute();
        if ($crud) {
            return "Cadastrado Com Sucesso";
        } else {
            return $this->getError();
        }
    }
}
