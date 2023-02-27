<?php

namespace App\Entity;

use App\Repository\MedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use phpDocumentor\Reflection\Types\Nullable;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
class Medecin extends User
{
   
    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner ce champ')]
    #[Assert\Length(
        min: 8,
        minMessage: 'Cette champ doit comporter au moins 8 caractères',
       
    )]
    private ?string $adresse_cabinet = null;

    #[ORM\Column(length: 255)]
    #[Assert\Positive]
    #[Assert\NotBlank(message: 'Veuillez renseigner ce champ')]
    #[Assert\Length(
        min: 8,
        max: 8,
        exactMessage: 'Cette champ doit comporter exactement 8 caractères',
       
    )]
    private ?string $fixe = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner ce champ')]
    #[Assert\Length(
        min: 8,
        minMessage: 'Cette champ doit comporter au moins 8 caractères',
       
    )]
    private ?string $diplome_formation = null;

    #[ORM\Column]
   // #[Assert\NotBlank(message: 'Veuillez renseigner ce champ')]
    #[Assert\Type(
    type: 'float',
    message: 'La valeur {{ valeur }} n\'est pas un {{ type }} valide. Il doit s\'agir d\'un entier ou d\'un flottant.')]
    #[Assert\Positive]
    #[Assert\NotNull]
    private ?float $tarif = null;

    #[ORM\Column]
    private ?bool $cnam = null;

   
    

    #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: Article::class)]
    private Collection $articles;

    #[ORM\ManyToOne(inversedBy: 'medecin')]
    private ?Specialites $specialites = null;

    #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: Consulation::class)]
    private Collection $consulations;

    #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: RendezVous::class)]
    private Collection $rendezVouses;

    // #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: Images::class)]
    // private Collection $imagesCabinet;

    #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: Dossier::class)]
    private Collection $dossiers;

    #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: Avis::class)]
    private Collection $avis;

    #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: Assistant::class)]
    private Collection $assistant;

    #[ORM\Column(nullable: true)]
    private ?bool $enabled = null;

   
   
    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->consulations = new ArrayCollection();
        $this->rendezVouses = new ArrayCollection();
       
        $this->dossiers = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->assistant = new ArrayCollection();
        $this->enabled = false; // par défaut, le compte est désactivé
       
       
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAdresseCabinet(): ?string
    {
        return $this->adresse_cabinet;
    }

    public function setAdresseCabinet(string $adresse_cabinet): self
    {
        $this->adresse_cabinet = $adresse_cabinet;

        return $this;
    }

    public function getFixe(): ?string
    {
        return $this->fixe;
    }

    public function setFixe(string $fixe): self
    {
        $this->fixe = $fixe;

        return $this;
    }

    public function getDiplomeFormation(): ?string
    {
        return $this->diplome_formation;
    }

    public function setDiplomeFormation(string $diplome_formation): self
    {
        $this->diplome_formation = $diplome_formation;

        return $this;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(float $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function isCnam(): ?bool
    {
        return $this->cnam;
    }

    public function setCnam(bool $cnam): self
    {
        $this->cnam = $cnam;

        return $this;
    }

    
   

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setMedecin($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getMedecin() === $this) {
                $article->setMedecin(null);
            }
        }

        return $this;
    }

    public function getSpecialites(): ?Specialites
    {
        return $this->specialites;
    }

    public function setSpecialites(?Specialites $specialites): self
    {
        $this->specialites = $specialites;

        return $this;
    }

    /**
     * @return Collection<int, Consulation>
     */
    public function getConsulations(): Collection
    {
        return $this->consulations;
    }

    public function addConsulation(Consulation $consulation): self
    {
        if (!$this->consulations->contains($consulation)) {
            $this->consulations->add($consulation);
            $consulation->setMedecin($this);
        }

        return $this;
    }

    public function removeConsulation(Consulation $consulation): self
    {
        if ($this->consulations->removeElement($consulation)) {
            // set the owning side to null (unless already changed)
            if ($consulation->getMedecin() === $this) {
                $consulation->setMedecin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RendezVous>
     */
    public function getRendezVouses(): Collection
    {
        return $this->rendezVouses;
    }

    public function addRendezVouse(RendezVous $rendezVouse): self
    {
        if (!$this->rendezVouses->contains($rendezVouse)) {
            $this->rendezVouses->add($rendezVouse);
            $rendezVouse->setMedecin($this);
        }

        return $this;
    }

    public function removeRendezVouse(RendezVous $rendezVouse): self
    {
        if ($this->rendezVouses->removeElement($rendezVouse)) {
            // set the owning side to null (unless already changed)
            if ($rendezVouse->getMedecin() === $this) {
                $rendezVouse->setMedecin(null);
            }
        }

        return $this;
    }

  

    /**
     * @return Collection<int, Dossier>
     */
    public function getDossiers(): Collection
    {
        return $this->dossiers;
    }

    public function addDossier(Dossier $dossier): self
    {
        if (!$this->dossiers->contains($dossier)) {
            $this->dossiers->add($dossier);
            $dossier->setMedecin($this);
        }

        return $this;
    }

    public function removeDossier(Dossier $dossier): self
    {
        if ($this->dossiers->removeElement($dossier)) {
            // set the owning side to null (unless already changed)
            if ($dossier->getMedecin() === $this) {
                $dossier->setMedecin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setMedecin($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getMedecin() === $this) {
                $avi->setMedecin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Assistant>
     */
    public function getAssistant(): Collection
    {
        return $this->assistant;
    }

    public function addAssistant(Assistant $assistant): self
    {
        if (!$this->assistant->contains($assistant)) {
            $this->assistant->add($assistant);
            $assistant->setMedecin($this);
        }

        return $this;
    }

    public function removeAssistant(Assistant $assistant): self
    {
        if ($this->assistant->removeElement($assistant)) {
            // set the owning side to null (unless already changed)
            if ($assistant->getMedecin() === $this) {
                $assistant->setMedecin(null);
            }
        }

        return $this;
    }

    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(?bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

   

   

   
   

   

}
