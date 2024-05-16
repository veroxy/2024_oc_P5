<?php

#[AllowDynamicProperties]
class Contact
{
    private string $name         = '';
    private string $email        = '';
    private string $phone_number = '';
    private int    $id           = 0;

    public function __construct(array $req = null)
    {
        if ($req) {
            *
            $this->id           = $req['id'];
            $this->name         = $req['name'];
            $this->phone_number = $req['phone_number'];
            $this->email        = $req['email'];
            $this->id           = $req['id'];
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf("contact: #" . $this->id . "," . $this->name . " avec le mail : " . $this->email . " et le numéro " . $this->phone_number . ".\n");
    }

    public function list()
    {
        if ($this->db) {
            $sql   = 'SELECT * FROM contact ORDER BY id ASC';
            $query = $this->db->prepare($sql);
            $query->execute();
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
        $user_name = filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $match     = preg_match('/^[a-z-A-Z]{3}+/', $user_name);

        if ($match) {
            echo $this->$name = ucfirst($user_name);
        }
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
            echo $this->phone_number = strlen($phone) <= 14 ? $phone : $phone_number . '\n';
        } else {
            echo "Numero invalide !!\n";
        }
    }

}