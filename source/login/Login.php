<?php

namespace Source\Models;

require __DIR__ . "../../global/Crud.php";
require __DIR__ . "../../global/Connection.php";

use Source\Crud\Crud;

class Login extends Crud
{
    /**
     * @param loginUser
     * @param  passw
     * @return bool
     */
    public function verifyUserLogin($loginUser, $passw) //: bool
    {

        $userLogin = parent::select("*")->from("login")->where("nm_login = ? ", [$loginUser])->execute("fetch");

        if ($userLogin) {

            if (password_verify($passw, $userLogin->nm_senha)) {
                $_SESSION['userLogin'] = $userLogin;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function insertUser($data): bool
    {
        $crud = $this->insert("login", $data, "nm_login, nm_senha")->execute();

        return $crud;
    }

    public function indexUsers()
    {
        $crud = $this->select("cd_login as codigo, nm_login as email")->from("login")->execute("fetchAll");

        return $crud;
    }

    public function deleteUser($id)
    {
        $crud = $this->delete()->from("login")->where("cd_login = ?", [$id])->execute();

        return $crud;
    }

    public function resetPassword($email)
    {
        $rs = parent::select()->from("login")
            ->where("nm_login = ?", [$email])
            ->execute("fetch");

        if ($rs) {

            //senha que será enviado no email de recuperação
            // $newPasswordEmail = $this->generatorPasswordRandom(5);

            $newPasswordEmail = "admin123"; //$this->generatorPasswordRandom(5);

            // encriptografar a senha antes de atualizar
            $newPasswordDB = password_hash($newPasswordEmail, PASSWORD_DEFAULT);

            $update = parent::update("login", "nm_senha = ? ", [$newPasswordDB])
                ->where("nm_login = ?", [$email])
                ->execute();

            if ($update) {

                return $newPasswordEmail;

                if ($this->sendEmail($email, $newPasswordEmail)) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    private function generatorPasswordRandom($len, $uppercase = true, $lowercase = true, $number = true, $simbolos = true)
    {
        $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
        $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras lowercase
        $nu = "0123456789"; // $nu contem os números
        $si = "!@#$%¨&*()_+="; // $si contem os símbolos

        $pass = "";

        if ($uppercase) {
            // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
            $pass .= str_shuffle($ma);
        }

        if ($lowercase) {
            // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $pass
            $pass .= str_shuffle($mi);
        }

        if ($number) {
            // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $pass
            $pass .= str_shuffle($nu);
        }

        if ($simbolos) {
            // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $pass
            $pass .= str_shuffle($si);
        }

        // retorna a$pass embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr(str_shuffle($pass), 0, $len);
    }


    private function sendEmail($email, $message)
    {
        //Link usado para fazer o envio de email em localhost funcionar
        //https://felipeelia.com.br/como-enviar-e-mails-pelo-php-em-localhost-linux/

        // Este sempre deverá existir para garantir a exibição correta dos caracteres
        $headers = "MIME-Version: 1.1\n";
        // Para enviar o e-mail em formato HTML com codificação de caracteres Europeu Ocidental (usado no Brasil)
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        // E-mail que receberá a resposta quando se clicar no 'Responder' de seu leitor de e-mails
        $headers .= "Reply-To: evelynjogos@gmail.com\n";
        // $headers .= 'From: ProjetoModular';

        $arquivo = "<h1>Sua nova senha é:</h1> <h3>$message</h3> ";

        $from = "evelynbrandao15@gmail.com"; //$email

        $send = mail($from, "Nova senha de Projeto Modular ", $arquivo, $headers);

        //$send = mail("evelynbrandao15@gmail.com", "Nova senha de Projeto Modular ", $arquivo);
        return $send;
    }
}
