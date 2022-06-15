<?php

namespace App\Entity;

use App\Repository\ProdutoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProdutoRepository::class)]
class Produto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nome;

    #[ORM\Column(type: 'string', length: 255)]
    private $quantidade;

    #[ORM\Column(type: 'string', length: 255)]
    private $preco_unitario;

    #[ORM\ManyToOne(targetEntity: Categoria::class, inversedBy: 'produtos', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private $categoria;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descricao;

    #[ORM\Column(type: 'blob', nullable: true)]
    private $ProductImage;

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

    public function getQuantidade(): ?string
    {
        return $this->quantidade;
    }

    public function setQuantidade(string $quantidade): self
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    public function getPrecoUnitario(): ?string
    {
        return $this->preco_unitario;
    }

    public function setPrecoUnitario(string $preco_unitario): self
    {
        $this->preco_unitario = $preco_unitario;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

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

    public function getProductImage()
    {
        return $this->ProductImage;
    }

    public function setProductImage($ProductImage): self
    {
        $this->ProductImage = $ProductImage;

        return $this;
    }
}
