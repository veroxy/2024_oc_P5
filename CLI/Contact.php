<?php

#[AllowDynamicProperties]
class Contact
{
    private string $name = '';
    private string $email = '';
    private string $phone_number = '';
    private int    $id ;


    /**
     * @param PDO|array $objContact
     * @return void
     */
  /*  public static function setProps(PDO|array $objContact)
    {

        if ($objContact) {
            foreach ($objContact as $key => $value) {
                switch ($key) {
                    case "name":
                        $this->setName($value);
                        break;
                    case "email":
                        $this->setEmail($value);
                        break;
                    case "phone_number":
                        $this->setPhoneNumber($value);
                        break;
                    case "id":
                        $this->setId($value);
                        break;

                }
            }
        }

    }*/

    public function list()
    {
        if ($this->db) {
            $sql   = 'SELECT * FROM contact ORDER BY id ASC';
            $query = $this->db->prepare($sql);
            $query->execute();
            $value = $query->fetchAll();

            $mask = "|%5.5s |%-10.10s | %-10.10s | %-10.10s  |\n";
            printf($mask, 'id', 'name', 'email', 'phone_number');

            printf($mask, $value);

        }
        return $value ? $value : $this->sql_error;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId(int $value): void
    {
        $this->id = $value;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $phone_number
     */
    public function setPhoneNumber($phone_number): void
    {
        $phone = filter_var($phone_number, FILTER_SANITIZE_NUMBER_INT);
        $match = preg_match('/^[\+0-9\-]{10}+/', $phone);
        var_dump($phone_number, "filter var :", $phone, $match);
        if ($match) {
            echo "Numero valide : ";
            echo $this->phone_number = strlen($phone) >= 10 ? $phone : $phone_number . '\n';
        } else {
            echo "Numero invalide !!\n";
        }
    }

}