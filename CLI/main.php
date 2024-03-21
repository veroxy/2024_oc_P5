<?php
function ft_connexion()
{
    try {
        // Pensez à modifier cette ligne avec le nom de votre base de données et vos identifiants
        return new PDO('mysql:host=localhost;dbname=2024_oc_p5_cli;charset=utf8', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    } catch (Exception $e) {
        die('Erreur Connexion(): ' . $e->getMessage());
    }
}

function ft_detail()
{

}

function ft_create(array $params)
{
    $db          = ft_connexion() ?: NULL;
    $value       = "ERREUR, il y un  problème dans la requette";
    $email       = filter_var($params[1], FILTER_VALIDATE_EMAIL) ? $params[1] : NULL;
    $name_concat = implode(' ', array_slice(array_reverse($params), -2));


//    var_dump($name_concat, $params);
//   TOFIXED  var_dump($params, $name_concat, implode(array_slice($params, -2, 1)), end($params));

    if ($db) {
        $query = "INSERT INTO contact(`name`, `email`, `phone_number`) VALUES ('$name_concat', '$params[1]', '$params[2]')";
        $value = $db->query($query);
        echo "vous avez créer un nouveau contact: " . $params[0] . " avec le mail : " . $params[1] . " et le numéro " . $params[2] . "\n";
    }
    return $value;
}

function ft_delete($id)
{
    $db    = ft_connexion() ?: NULL;
    $value = "ERREUR, il y un  problème dans la requette";
    if ($db) {
        $query = "DELETE FROM contact WHERE contact.id=$id";
        $value = $db->query($query);
        echo "Vous avez supprimé le contact $id \n";
    }
    return $value;
}

function ft_quit()
{

}

function ft_list()
{
    $db    = ft_connexion() ?: NULL;
    $value = "ERREUR, il y un  problème dans la requette";
    if ($db) {
        $sql   = 'SELECT * FROM contact ORDER BY id ASC';
        $query = $db->prepare($sql);
        $query->execute();
        $reqAll = $query->fetchAll();

        $mask = "|%5.5s |%-10.10s | %-10.10s | %-10.10s  |\n";
        printf($mask, 'id', 'name', 'email', 'phone_number');
        printf($mask, $reqAll);
//        var_dump($reqAll);


    }
    return $value;
}

function ft_help()
{
    echo
    "
list : Afficher la liste des contacts.\n
detail :  Afficher le détail d’un contact.\n
create [name], [email], [phone number] : Ajouter un contact.\n
delete [id] : Supprimer un contact.\n 
quit : Quitter le programme.\n
update:  modifier un contact.\n 
 ";
}

function ft_update(array $params)
{

}

//create morane m.lm@gmail.com +97867258254
while (true) {
    $input = readline("Entrez votre commande : ");
    echo "Vous avez saisi : $input\n";
    /*    - Afficher la liste des contacts : list.
    - Afficher le détail d’un contact : detail.
        - Ajouter un contact : create [name], [email], [phone number].
    - Supprimer un contact : delete [id].
        - Quitter le programme : quit.
        - En bonus : vous pouvez décider d’ajouter une commande pour afficher l’aide et une autre pour modifier un contact. */
    $params  = explode(' ', trim($input));
    $command = $params[0];
    if (is_array($params) & count($params) >= 2) {
        array_shift($params);
        var_dump("SWITCH", $command, $params);

        switch ($command) {
            case "create" :
                if (count($params) >= 3) {
                    ft_create($params); //[name, email, phone_number]
                } else {
                    echo count($params) . "paramètres, il vous manque un ou plusieurs paramètres.\n";
                }
                break;
            case "update" :
                if (count($params) === 1 && is_integer($params[0])) {
                    ft_update($params[0]); // [$id]
                } else {
                    echo count($params) . " paramètres, vérifiez vos paramètres.\n";
                }
                break;
            case "delete" :
                if (count($params) === 1 && is_numeric($params[0])) {
                    ft_delete($params[0]); // [$id]
                } else {
                    echo count($params) . " paramètres, vérifiez vos paramètres.\n";
                }
                break;
            case  "aide":
                ft_help();
                break;
            default:
                ft_help();
                break;
        }
    } else {
        switch ($command) {
            case "list" :
                ft_list();
                break;
            case "detail" :
                ft_detail();
                break;
            case "quit" :
                ft_quit();
                break;
            case  "aide":
                ft_help();
                break;
            default:
                ft_help();
                break;
        }
    }
}
