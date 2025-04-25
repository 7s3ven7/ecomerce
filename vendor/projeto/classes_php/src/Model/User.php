<?php

namespace wesley\Model;

use wesley\DB\Sql;
use wesley\Model;

class User extends Model
{
    const SESSION = "User";

    public static function Login (string $login, string $password):User
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_users WHERE deslogin = :login",array(
            ":login" => $login
        ));
        if(count($result) === 0)
        {
            throw new \Exception("Nenhum usuário encontrado");
        }

        $data = $result[0];

        if(password_verify($password, $data['despassword']) === true)
        {
            $user = new User();
            $user->setData($data);

            $_SESSION[USER::SESSION] = $user->getValues();

            return $user;
        }else {
            throw new \Exception("Senha incorreta");

        }
    }

    public static function verifyLogin($inadmin = true):void
    {

        if (
            !isset($_SESSION[User::SESSION])
            ||
            !$_SESSION[User::SESSION]
            ||
            !(int)$_SESSION[User::SESSION]["iduser"] > 0
            ||
            (bool)$_SESSION[User::SESSION]["iduser"] !== $inadmin
        ) {

            header("Location: /admin/login");
            exit;

        }

    }

    public static function Logout ():void{
        $_SESSION[User::SESSION] = null;
    }

    public static function ListAll ():array{
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) ORDER BY b.desperson ASC");
    }
}