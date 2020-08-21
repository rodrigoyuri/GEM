<?php

namespace Source\Models;


use Source\Crud\Crud;

class Afiliado extends Crud
{

    public function indexFilter($data = array())
    {
        $table = "afiliado";
        $tablePrimaryKey = "cd_afiliado";

        // $columns = array(
        //     array('db' => 'nm_afiliado', 'dt' => 0),
        //     array('db' => 'nm_tipo_afiliado',  'dt' => 1),
        //     array('db' => 'dt_nascimento',   'dt' => 2),
        //     array('db' => 'cd_telefone',     'dt' => 3)
        // );
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

        $query = parent::select("nm_afiliado, nm_tipo_afiliado, dt_nascimento, cd_telefone")
            ->from("afiliado")
            ->where("nm_afiliado LIKE (?)", ["%{$data["search"]['value']}%"])
            ->order($orderBy, $typeOrderBy)
            ->limit($start, $end)
            ->execute("fetchAll");


        $totalRegisterInTable = parent::select("COUNT(*) as count")->from("afiliado")->execute("fetch")->count;
        $totalRegisterInQuery = count($query);


        $jsonData = array(
            "draw" => intval($data["draw"]),
            "recordsTotal" => intval($totalRegisterInTable),
            "recordsFiltered" => intval($totalRegisterInQuery),
            "data" => $query
        );

        return $jsonData;
    }
}
