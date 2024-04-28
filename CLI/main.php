<?php

namespace Cli;

use ContactManager;

include "ContactManager.php";
include "Command.php";
/*
function ft_detail()
{

}
*/
/*
function toString(Contact $contact)
{

    echo " contact: #" . $contact->id . "," . $contact->name . " avec le mail : " . $contact->email . " et le numéro " . $contact->phone_number . ".";
}*/
function objectExist($entity, $array, $new_element)
{
    if ($entity) {

    } else {
        array_push($array, $new_element);
    }
    return $array;
}

function ft_colorError(string $str)
{
    //The characters \033 indicate the start of an escape code. [31m is the colour red. [0m signifies the end of the coded fragment.
    return "\033[31m" . $str . "\033[0m";

}

function ft_colorSucces(string $str)
{
    //The characters \033 indicate the start of an escape code. [31m is the colour red. [0m signifies the end of the coded fragment.
    return "\033[32m" . $str . "\033[0m";
}

function ft_readline($qa = false)
{
    if(!$qa) {
        $input = readline("Entrez votre commande (help, list, create, detail,delete, quit) : ");
        /*for($i=1; $i<3; ++$i){
            $input = !empty($input) ? $input : ft_readline();
        }*/
        echo !empty($input) ? "Vous avez saisi : $input\n" : ft_colorError("vous n'avez rien saisi.\n");
    }else{
        $input = readline("Oui(O) ou Non(N) : ");
        $input = $input === strtolower("O") ? true : false;
    }
    return $input;
}

function ft_getParamNb(array $params, int $nb, $ft_command)
{
    return count($params) == $nb ? $ft_command : sprintf(ft_colorError(count($params) . " paramètres, il vous manque un ou plusieurs paramètres.\n"));
}

$contacts = [];

//create morane m.lm@gmail.com +97867258254
while (true) {
    $input = ft_readline();
    $input = trim($input);
//    echo !empty($input) ?  "Vous avez saisi : $input\n" : "Voici la list des commandes possibles : ";
    $params  = explode(' ', trim($input));
    $command = strtolower($params[0]);
    array_shift($params);


    $contact = new ContactManager();
    $cmd     = new Command($contact);


    switch ($command) {
        case "create" :
            // TOFIXED element contact::setProp(xx)
            if (count($params) == 4) {
                $params[1] = $params[0] .' '. $params[1];
                array_shift($params);
            var_dump($params);
            }

            $props = ft_getParamNb($params, 3, $cmd->create($params));
            array_push($contacts, $props);
            break;
        case "update" :
//            if (count($params) === 1 && is_integer($params[0])) {
            if (is_integer($params[0])) {
                ft_getParamNb($params, 3, $cmd->update($params[0]));
            }
            break;
        case "delete" :
            if (is_numeric($params[0])) {
                ft_getParamNb($params, 1, $cmd->delete($params[0]));
                $cmd->list();
            } else {
                echo ft_colorError(count($params) . " paramètres, vérifiez vos paramètres.\n");
            }
            break;
        case "list" :

            $contacts = $cmd->list();

            break;
        case  "detail":
            if (count($params) > 0) {
                ft_getParamNb($params, 1, $cmd->detail($params[0]));
            }
            break;
        case  "quit":
            $cmd->quit();
            break;
        case  "help":
            $cmd->help();
            break;
        default:
            $cmd->help();
            break;
    }
}
