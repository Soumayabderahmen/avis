<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
class Patient extends User
{
    #[ORM\OneToMany(mappedBy: 'patients', targetEntity: Consulation::class)]
    private Collection $consulations;

    #[ORM\OneToMany(mappedBy: 'patient', targetEntity: Paiement::class)]
    private Collection $paiements;

    #[ORM\OneToMany(mappedBy: 'patient', targetEntity: Dossier::class)]
    private Collection $dossiers;

    #[ORM\OneToMany(mappedBy: 'patient', targetEntity: Diagnostique::class)]
    private Collection $diagnostiques;

    #[ORM\OneToMany(mappedBy: 'patient', targetEntity: Avis::class)]
    private Collection $avis;

   

    public function __construct()
    {
        $this->consulations = new ArrayCollection();
        $this->paiements = new ArrayCollection();
        $this->dossiers = new ArrayCollection();
        $this->diagnostiques = new ArrayCollection();
        $this->avis = new ArrayCollection();
        
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
            $consulation->setPatients($this);
        }

        return $this;
    }

    public function removeConsulation(Consulation $consulation): self
    {
        if ($this->consulations->removeElement($consulation)) {
            // set the owning side to null (unless already changed)
            if ($consulation->getPatients() === $this) {
                $consulation->setPatients(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Paiement>
     */
    public function getPaiements(): Collection
    {
        return $this->paiements;
    }

    public function addPaiement(Paiement $paiement): self
    {
        if (!$this->paiements->contains($paiement)) {
            $this->paiements->add($paiement);
            $paiement->setPatient($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): self
    {
        if ($this->paiements->removeElement($paiement)) {
            // set the owning side to null (unless already changed)
            if ($paiement->getPatient() === $this) {
                $paiement->setPatient(null);
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
            $dossier->setPatient($this);
        }

        return $this;
    }

    public function removeDossier(Dossier $dossier): self
    {
        if ($this->dossiers->removeElement($dossier)) {
            // set the owning side to null (unless already changed)
            if ($dossier->getPatient() === $this) {
                $dossier->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Diagnostique>
     */
    public function getDiagnostiques(): Collection
    {
        return $this->diagnostiques;
    }

    public function addDiagnostique(Diagnostique $diagnostique): self
    {
        if (!$this->diagnostiques->contains($diagnostique)) {
            $this->diagnostiques->add($diagnostique);
            $diagnostique->setPatient($this);
        }

        return $this;
    }

    public function removeDiagnostique(Diagnostique $diagnostique): self
    {
        if ($this->diagnostiques->removeElement($diagnostique)) {
            // set the owning side to null (unless already changed)
            if ($diagnostique->getPatient() === $this) {
                $diagnostique->setPatient(null);
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
            $avi->setPatient($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getPatient() === $this) {
                $avi->setPatient(null);
            }
        }

        return $this;
    }

 
 
}
