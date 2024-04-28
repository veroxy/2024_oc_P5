<?php

use function Cli\ft_colorSucces;

include "Contact.php";
include "DBConnect.php";


class ContactManager
{

    private $db;

    public function __construct()
    {
        $this->getDb();
    }


    /**
     * @return PDO|null
     */
    public function getDb(): ?PDO
    {
        $this->db = new DBConnect();
        $this->db = $this->db->getPDO();
        return $this->db;
    }

    function inDbb($column)
    {
        $sql = "";

    }

    /**
     * @param array $params
     * @return false|PDOStatement|string
     */
    function create(array $params)
    {
        $req          = "ERREUR, il y un  problème dans la requette";
        $email        = filter_var($params[1], FILTER_VALIDATE_EMAIL) ? $params[1] : NULL;
        $name_contact = implode(' ', array_slice(array_reverse($params), -1));
        $phone        = filter_var($params[2], FILTER_SANITIZE_NUMBER_INT);
        $phone_number = strlen($phone) >= 10 && strlen($phone) < 20 ? $phone : false;
        if ($this->db && $phone_number) {
            $sql   = "INSERT INTO contact(`name`, `email`, `phone_number`) VALUES ('$name_contact', '$email', '$phone_number')";
            $query = $this->db->prepare($sql);
            $query->execute();

           echo ft_colorSucces("vous avez créer un nouveau contact: " . $name_contact . " avec le mail : " . $email . " et le numéro " . $phone_number . "\n");

            // risque d'erreur multiples inseetions ??
//            $sql   = "SELECT * FROM `contact` ORDER BY id DESC LIMIT 1";

            $sql   = "SELECT * FROM `contact` WHERE phone_number=:phone_number";
            $query = $this->db->prepare($sql);
            $query->BindParam('phone_number', $phone_number);
            $query->execute();
            $req = new Contact($query->fetch());
        }

        return $req;
    }

    /**
     * @return array
     */
    public function findAll(): array
    {

        try {
            if ($this->db) {
                $sql   = 'SELECT * FROM contact ORDER BY id ASC';
                $query = $this->db->prepare($sql);
                $query->execute();
                $req = $query->fetchAll();
                return self::getParam($req);

            }
        } catch (Exception $e) {
            die('Erreur dans la requette de LISTING : ' . $e->getMessage());
        }

    }

    /**
     * /**
     * @return array $contact
     * Dans cette classe, créez en particulier une méthode findAll() qui ne prend rien en paramètre et retourne un tableau. Chaque élément du tableau contiendra les informations d’un contact (le résultat du fetch). Le but de cette méthode sera de réaliser une requête SQL pour récupérer l’ensemble des contacts.
     * N’oubliez pas de tester tout de suite le résultat directement dans la méthode findAll. Le but est à nouveau de s’assurer que tout fonctionne avant d’aller plus loin et d’empiler les bugs !
     */
    public static function getParam(array $reqAll): array
    {
        $contacts = [];
        foreach ($reqAll as $key => $contact) {
            $n                        = new Contact($contact);
            $contacts[$contact['id']] = $n;
            print_r("Ceci est le Contact #" . $contact['id'] . ", s'appelant " . $contact['name'] . " avec le mail : " . $contact['email'] . " et le numéro " . $contact['phone_number'] . "\n");
        }

        return $contacts;
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(int $id): void
    {
        $pdo     = $this->getOne($id);
        $contact = new Contact();


        $contact::setProps($pdo);
    }

    public function getOne(int $id)
    {
        if ($this->db) {
            $sql   = "SELECT * FROM contact WHERE id=:id";
            $query = $this->db->prepare($sql);
            $query->BindParam('id', $id, PDO::PARAM_INT);
            $query->execute();

            $req     = $query->fetch();
            $contact = new Contact($req);
            echo ft_colorSucces($contact->__toString());
            return $contact;
        }
    }

    /**
     * @param int $ $contact
     * @return false|PDOStatement|string
     */
    function delete(int $id)
    {
        $value   = "ERREUR, il y un  problème dans la requete";
        echo "etes vous sûr de vouloir suprimer le " .
        $this->getOne($id);

//        echo("\e[0m\e[34mPromt>\e[0m");
        $validsdtin = \Cli\ft_readline(true);
        if($validsdtin) {
            if ($this->db) {
                $sql   = "DELETE FROM contact WHERE id=:id";
                $query = $this->db->prepare($sql);
                $query->BindParam('id', $id, PDO::PARAM_INT);
                $query->execute();
                echo ft_colorSucces("Vous avez supprimé le contact $id")."\n";
            }
        }
        else{
            echo "vous vous etes trompé de contact? recommencez.\n";
        }
        return $value;
    }

    public function update(Contact $contact)
    {

    }


}