<?php

namespace App\Entity;

use App\Repository\VendaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VendaRepository::class)]
class Venda
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $data_efetuada;

    #[ORM\Column(type: 'date', nullable: true)]
    private $data_finalizada;

    #[ORM\ManyToOne(targetEntity: Fornecedor::class, inversedBy: 'produtos_vendidos', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private $fornecedor;

    #[ORM\ManyToOne(targetEntity: Produto::class, cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private $produto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataEfetuada(): ?\DateTimeInterface
    {
        return $this->data_efetuada;
    }

    public function setDataEfetuada(\DateTimeInterface $data_efetuada): self
    {
        $this->data_efetuada = $data_efetuada;

        return $this;
    }

    public function getDataFinalizada(): ?\DateTimeInterface
    {
        return $this->data_finalizada;
    }

    public function setDataFinalizada(?\DateTimeInterface $data_finalizada): self
    {
        $this->data_finalizada = $data_finalizada;

        return $this;
    }

    public function getFornecedor(): ?Fornecedor
    {
        return $this->fornecedor;
    }

    public function setFornecedor(?Fornecedor $fornecedor): self
    {
        $this->fornecedor = $fornecedor;

        return $this;
    }

    public function getProduto(): ?Produto
    {
        return $this->produto;
    }

    public function setProduto(?Produto $produto): self
    {
        $this->produto = $produto;

        return $this;
    }
}
