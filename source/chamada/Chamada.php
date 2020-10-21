<?php

namespace Source\Models;

use Source\Crud\Crud;

class Chamada extends Crud
{

    public function indexFilter($data = array())
    {
        $columns = array(
            "0" => "nm_afiliado",
            "1" => "nm_status_voluntario",
        );

        $orderBy = "{$columns[$data['order'][0]['column']]}";
        $typeOrderBy = $data['order'][0]['dir'];
        $start = $data['start'];
        $end = $data['length'];

        $queryFilter = parent::select("cd_afiliado, nm_afiliado, nm_status_voluntario, ROUND(((qt_presencas / qt_total_disponibilidade_ano) * 100)) AS Frequencia")
            ->from("afiliado, chamada")->where("cd_afiliado = id_afiliado");

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
            "data" => $query,
        );

        return $jsonData;
    }

    public function updatePresent($data = [])
    {
        $setFaults = parent::update("chamada", "qt_presencas = qt_presencas - ?", [1])->execute();

        if($setFaults) {
            if(!empty($data)) {
                $setPresents = parent::update("chamada", "qt_presencas = qt_presencas + ?", [1])->where("id_afiliado IN (?)", $data)->execute();

                if ($setPresents) {
                    return "Chamada Efetuada com Sucesso";
                } else {
                    return "Erro ao efetuar o calculo da presença";
                }
            } else {
                return "Chamada Efetuada com sucesso\n todos receberam faltas";
            }
        } else {
            return "Erro ao efetuar a contagem de faltas";
        }
    }

    public function toggleAffiliate(int $id = null)
    {
        $presents = parent::update("afiliado", "nm_status_voluntario = !nm_status_voluntario", [])->where("cd_afiliado = ?", [$id])->execute();

        if ($presents || NULL) {
            return "Modificado com sucesso";
        } else {
            return "Erro ao modificar";
        }
    }

    public function reset()
    {
        $reset = parent::call("prc_reset_chamada()")->execute();

        return $reset;
    }
}
