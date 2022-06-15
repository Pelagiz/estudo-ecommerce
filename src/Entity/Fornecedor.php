<?php

namespace App\Entity;

use App\Repository\FornecedorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FornecedorRepository::class)]
class Fornecedor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nome;

    #[ORM\Column(type: 'string', length: 255)]
    private $cnpj;

    #[ORM\OneToOne(targetEntity: Endereco::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'endereco_id', referencedColumnName: 'id')]
    private $endereco;

    #[ORM\OneToMany(mappedBy: 'fornecedor_id', targetEntity: Venda::class)]
    private $produtos_vendidos;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descricao;

    public function __construct()
    {
        $this->produtos_vendidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(string $cnpj): self
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    public function getEndereco(): ?Endereco
    {
        return $this->endereco;
    }

    public function setEndereco(?Endereco $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * @return Collection<int, Venda>
     */
    public function getProdutosVendidos(): Collection
    {
        return $this->produtos_vendidos;
    }

    public function addProdutosVendido(Venda $produtosVendido): self
    {
        if (!$this->produtos_vendidos->contains($produtosVendido)) {
            $this->produtos_vendidos[] = $produtosVendido;
            $produtosVendido->setFornecedorId($this);
        }

        return $this;
    }

    public function removeProdutosVendido(Venda $produtosVendido): self
    {
        if ($this->produtos_vendidos->removeElement($produtosVendido)) {
            // set the owning side to null (unless already changed)
            if ($produtosVendido->getFornecedorId() === $this) {
                $produtosVendido->setFornecedorId(null);
            }
        }

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }
}
