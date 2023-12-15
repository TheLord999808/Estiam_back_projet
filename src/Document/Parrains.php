<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

#[ODM\Document]
class Parrains{

    #[ODM\Id(strategy: "AUTO")]
    private $id;

    #[ODM\Field(type: "string")]
    private $Civilite;

    #[ODM\Field(type: "string")]
    private $Nom;

    #[ODM\Field(type: "string")]
    private $Prenom;

    #[ODM\Field(type: "string")]
    private $Mandat;

    #[ODM\Field(type: "string")]
    private $Circonscription;

    #[ODM\Field(type: "string")]
    private $Departement;

    #[ODM\Field(type: "string")]
    private $Candidat;

    #[ODM\Field(type: "string")]
    private $DatePublication;

    // Getter et Setter pour Id
    public function getId(): ?string {
        return $this->id;
    }
    
    public function setId(?string $id): void {
        $this->id = $id;
    }

    // Getter et Setter pour Civilité
    public function getCivilite(): ?string
    {
        return $this->Civilite;
    }

    public function setCivilite(string $Civilite): self
    {
        $this->Civilite = $Civilite;
        return $this;
    }

    // Getter et Setter pour Nom
    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;
        return $this;
    }

    // Getter et Setter pour Prenom
    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;
        return $this;
    }

    // Getter et Setter pour Mandat
    public function getMandat(): ?string
    {
        return $this->Mandat;
    }

    public function setMandat(string $Mandat): self
    {
        $this->Mandat = $Mandat;
        return $this;
    }

    // Getter et Setter pour Circonscription
    public function getCirconscription(): ?string
    {
        return $this->Circonscription;
    }

    public function setCirconscription(string $Circonscription): self
    {
        $this->Circonscription = $Circonscription;
        return $this;
    }

    // Getter et Setter pour Departement
    public function getDepartement(): ?string
    {
        return $this->Departement;
    }

    public function setDepartement(string $Departement): self
    {
        $this->Departement = $Departement;
        return $this;
    }

    // Getter et Setter pour Candidat
    public function getCandidat(): ?string
    {
        return $this->Candidat;
    }

    public function setCandidat(string $Candidat): self
    {
        $this->Candidat = $Candidat;
        return $this;
    }

    // Getter et Setter pour DatePublication
    public function getDatePublication(): ?string
    {
        return $this->DatePublication;
    }

    public function setDatePublication(string $DatePublication): self
    {
        $this->DatePublication = $DatePublication;
        return $this;
    }
    
}