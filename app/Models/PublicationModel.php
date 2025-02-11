<?php

namespace App\Models;

use CodeIgniter\Model;

class PublicationModel extends Model
{
    protected $table = 'publications';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        "titre", 
        "description",
        "id_utilisateur",
        "date_creation",
        "categorie"
    ];

    public function getPublication() {
        $this->select('publications.titre, publications.categorie, utilisateurs.id as utilisateur_id, publications.id as publication_id, publications.description, publications.date_creation, utilisateurs.telephone');
        $this->join('utilisateurs', 'utilisateurs.id = publications.id_utilisateur');
        return $this->findAll();
    }
}
