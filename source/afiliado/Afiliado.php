<?php

namespace Source\Models;


use Source\Crud\Crud;

class Afiliado extends Crud
{

    public function showAffiliate(int $id)
    {
        $query = parent::select("cd_afiliado as cod, nm_afiliado as nome, cd_rg as rg, cd_cpf as cpf,
                                nm_nacionalidade as nacionalidade, ic_sexo as sexo, DATE_FORMAT(dt_nascimento, '%d/%m/%Y') as data,
                                nm_endereco as endereco, cd_telefone as telefone,cd_contato as celular, nm_email as email,
                                nm_situacao_profissional qualificacao , nm_tipo_afiliado as tipo, nm_area_interesse as funcao,
                                nm_disponibilidade as week, nm_status_assistida as estado_da_assistida, nm_status_voluntario as statusVol, dt_inicio_afiliado as data_ingressao")
            ->from("afiliado")->where("cd_afiliado = ?", [$id])->execute("fetch");

        $endereco = explode(";", $query->endereco);
        $query->estado = (isset($endereco[0])) ? $endereco[0] : null;
        $query->cidade = (isset($endereco[1])) ? $endereco[1] : null;
        $query->bairro = (isset($endereco[2])) ? $endereco[2] : null;
        $query->rua = (isset($endereco[3])) ? $endereco[3] : null;
        $query->numero = (isset($endereco[4])) ? $endereco[4] : null;
        $query->complemento = (isset($endereco[5])) ? $endereco[5] : null;
        $query->cep = (isset($endereco[6])) ? $endereco[6] : null;
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
            "2" => "nm_area_interesse",
            "3" => "status",
        );

        $orderBy = "{$columns[$data['order'][0]['column']]}";
        $typeOrderBy = $data['order'][0]['dir'];
        $start = $data['start'];
        $end = $data['length'];

        $queryFilter = parent::select("cd_afiliado, nm_afiliado, nm_tipo_afiliado, nm_area_interesse, DATE_FORMAT(dt_nascimento, '%d/%m/%Y') as dt_nascimento, cd_contato, CONCAT(nm_tipo_afiliado,';',COALESCE(nm_status_voluntario,'-'), ';', COALESCE(nm_status_assistida, '-')) as status ")
            ->from("afiliado");

        if (!empty($data["search"]['value'])) {
            $searchLike = "%{$data["search"]['value']}%";
            $queryFilter = $queryFilter
                ->where("nm_afiliado LIKE (?) OR nm_area_interesse LIKE (?) OR DATE_FORMAT(dt_nascimento, '%d/%m/%Y') LIKE(?)",
                 [$searchLike, $searchLike, $searchLike]);
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
        $crud = $this->insert("afiliado", $data, "cd_contato,
                                                  cd_cpf,
                                                  dt_nascimento,
                                                  dt_inicio_afiliado,
                                                  nm_email,
                                                  nm_endereco,
                                                  nm_status_assistida,
                                                  nm_area_interesse,
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
        $crud = $this->update("afiliado", "cd_contato = ?,
                                            cd_cpf = ?,
                                            dt_nascimento = ?,
                                            dt_inicio_afiliado = ?,
                                            nm_email = ?,
                                            nm_endereco = ?,
                                            nm_status_assistida = ?,
                                            nm_area_interesse = ?,
                                            nm_nacionalidade = ?,
                                            nm_afiliado = ?,
                                            nm_situacao_profissional = ?,
                                            cd_rg = ?,
                                            ic_sexo = ?,
                                            cd_telefone = ?,
                                            nm_tipo_afiliado = ?,
                                            nm_disponibilidade = ?", $data)
            ->where("cd_afiliado = ?", [$id])->execute();

            $resetFrequenciAffiliate = parent::call("prc_reset_chamada_id(?)", [$id])->execute();

        if ($crud && $resetFrequenciAffiliate) {
            return "Atualizado Com Sucesso";
        } else {
            return $this->getError();
        }
    }

    public function deleteAffiliate($id){
       
        $crud = $this->delete()->from("afiliado")->where("cd_afiliado = ?", [$id])->execute();

        return $crud;
    }

    public function insertItem(array $data = null)
    {
        $query = $this->insert("item", $data, "qt_item, nm_item, id_afiliado")->execute();

        if ($query) {
            return "Item cadastrado";
        } else {
            return $this->getError();
        }
    }
    public function showItems(int $id)
    {
        $query = $this->select("cd_item as id, qt_item as qt, nm_item as nome, dt_aquisicao as data")
            ->from("item")
            ->where("id_afiliado = ?", [$id])
            ->execute("fetchAll");

        return $query;
    }

    public function deleteItem(int $id) 
    {
        $crud = $this->delete()->from("item")->where("cd_item = ?", [$id])->execute();

        return $crud;
    }
}
