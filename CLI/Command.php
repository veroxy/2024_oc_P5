<?php

namespace Cli;

use ContactManager;
use PDOStatement;

class Command
{

    private $contact;

    public function __construct(ContactManager $contactManager)
    {
        return $this->contact = new ContactManager($contactManager);
    }


    /**
     * @param int $id
     * @return null
     */
    public function detail(int $id)
    {
        return $this->contact->show($id);
    }

    /**
     * @param array $contact
     * @return false|PDOStatement|string
     */
    public function create(array $contact)
    {
        return $this->contact->create($contact);
    }

    /**
     * @return null
     */
    public function list()
    {
        return $this->contact->findAll();
    }

    /**
     * @param int $id
     * @return false|PDOStatement|string
     */
    public function delete(int $id)
    {

        return $this->contact->delete($id);
    }

    /**
     * @return void
     */
    public function help()
    {
        echo
        "
        Voici les entrés valides:
        
        list : Afficher la liste des contacts.\n
        detail [id] :  Afficher le détail d’un contact.\n
        create [name], [email], [phone number] : Ajouter un contact.\n
        delete [id] : Supprimer un contact.\n 
        quit : Quitter le programme.\n";
    }

    /***
     * @return void
     */
    public function quit()
    {
        echo "Vous quittez le répertoire de contacts\n";
        exit('Good Bye !! ');
    }

    public function showContacts($contacts)
    {
        if (is_array($contacts)) {
            foreach ($contacts as $contact) {
                echo $contact->__toString();
            }
        } else {
            var_dump($contacts);
            echo $contacts->__toString();

        }
    }
}