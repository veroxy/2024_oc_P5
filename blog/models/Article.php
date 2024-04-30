<?php

/**
 * Entité Article, un article est défini par les champs
 * id, id_user, title, content, date_creation, date_update
 */
class Article extends AbstractEntity
{
    private int       $idUser;
    private string    $title        = "";
    private string    $content      = "";
    private ?DateTime $dateCreation = null;
    private ?DateTime $dateUpdate   = null;
    private array | int     $comments     = [];
    private int       $views        = 0;
    private string    $slug         = "";

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if ($data) {
            $this->setSlug($data['title']);
        }
    }

    public function getSlug(): string
    {

        return $this->slug;
    }

    public function setSlug(string $input): void
    {
        $textlower = isset($input) ? strtolower($input) : strtolower($this->title);
        //convert special characters to normal
        $utf8normal   = iconv('utf-8', 'ascii//TRANSLIT', $textlower);
        $specialchars = preg_replace("/[:']/", '', $utf8normal);
        $this->slug   = str_replace(' ', '_', $specialchars);

    }


    public function getViews(): int
    {
        return $this->views;
    }

    public function setViews(int $views): void
    {
        $this->views = $views;
    }

    /**
     * @return array
     */
    public function getComments(): array | int
    {
        return $this->comments;
    }

    /**
     * @param array $comments
     */
    public function setComments(array | int $comments): void
    {
        $this->comments = $comments;
    }

    /**
     * Getter pour l'id de l'utilisateur.
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * Setter pour l'id de l'utilisateur.
     * @param int $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * Getter pour le titre.
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Setter pour le titre.
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Getter pour le contenu.
     * Retourne les $length premiers caractères du contenu.
     * @param int $length : le nombre de caractères à retourner.
     * Si $length n'est pas défini (ou vaut -1), on retourne tout le contenu.
     * Si le contenu est plus grand que $length, on retourne les $length premiers caractères avec "..." à la fin.
     * @return string
     */
    public function getContent(int $length = -1): string
    {
        if ($length > 0) {
            // Ici, on utilise mb_substr et pas substr pour éviter de couper un caractère en deux (caractère multibyte comme les accents).
            $content = mb_substr($this->content, 0, $length);
            if (strlen($this->content) > $length) {
                $content .= "...";
            }
            return $content;
        }
        return $this->content;
    }

    /**
     * Setter pour le contenu.
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Getter pour la date de création.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime.
     * @return DateTime|IntlDateFormatter |string
     */
    public function getDateCreation(): DateTime|IntlDateFormatter|string
    {

        /* if (!is_string($this->dateCreation)) {
             $dateCreation = new IntlDateFormatter('fr_FR',IntlDateFormatter::FULL,
                 IntlDateFormatter::FULL,
                 'Europe/Paris',
                 IntlDateFormatter::GREGORIAN,
                 'MM/dd/yyyy');
            return $dateCreation->format($this->dateCreation);
         }*/

        return $this->dateCreation;
    }

    /**
     * Setter pour la date de création. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateCreation
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé.
     */
    public function setDateCreation(string|DateTime $dateCreation, string $format = 'Y-m-d H:i:s'): void
    {
        if (is_string($dateCreation)) {
            $dateCreation = DateTime::createFromFormat($format, $dateCreation);
        }
        $this->dateCreation = $dateCreation;
    }

    /**
     * Getter pour la date de mise à jour.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime ou null
     * si la date de mise à jour n'a pas été définie.
     * @return DateTime|null
     */
    public function getDateUpdate(): ?DateTime
    {
        return $this->dateUpdate;
    }

    /**
     * Setter pour la date de mise à jour. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateUpdate
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé.
     */
    public function setDateUpdate(string|DateTime $dateUpdate, string $format = 'Y-m-d H:i:s'): void
    {
        if (is_string($dateUpdate)) {
            $dateUpdate = DateTime::createFromFormat($format, $dateUpdate);
        }
        $this->dateUpdate = $dateUpdate;
    }
}