<?php

namespace wesley;

class Model
{
    private array $values = ["teste" => "a"];

    protected $fields = [
        "iduser", "idperson", "deslogin", "despassword", "inadmin", "dtergister"
    ];
    public function __call($name, $arguments)
    {
        $method = substr($name, 0, 3);
        $fieldName = substr($name, 3, strlen($name));

        if (in_array($fieldName, $this->fields))
        {
            switch ($method)
            {
                case "get":
                    return $this->values[$fieldName];
                case "set":
                    $this->values[$fieldName] = $arguments[0];
                    break;
            }
        }
    }

    public function setData($data = array()):void
    {

        foreach ($data as $key => $value) {
            $this->{'set'.$key}($value);

        }
    }

    public function getValues():array
    {
        return $this->values;
    }
}