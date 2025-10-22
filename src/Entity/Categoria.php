<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoriaRepository::class)]
class Categoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
      #[Groups("api_list")]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
      #[Groups("api_list")]
    private ?string $descricaocategoria = null;



    public function __construct()
    {
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricaocategoria(): ?string
    {
        return $this->descricaocategoria;
    }

    public function setDescricaocategoria(string $descricaocategoria): static
    {
        $this->descricaocategoria = $descricaocategoria;

        return $this;
    }

    /**
     * @return Collection<int, Produto>
     */
    public function getProdutos(): Collection
    {
        return $this->produtos;
    }

    public function addProduto(Produto $produto): static
    {
        if (!$this->produtos->contains($produto)) {
            $this->produtos->add($produto);
            $produto->setCategoria($this);
        }

        return $this;
    }

    public function removeProduto(Produto $produto): static
    {
        if ($this->produtos->removeElement($produto)) {
            // set the owning side to null (unless already changed)
            if ($produto->getCategoria() === $this) {
                $produto->setCategoria(null);
            }
        }

        return $this;
    }
}
