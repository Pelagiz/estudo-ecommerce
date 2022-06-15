<?php

namespace App\Entity;

use App\Repository\CompraRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompraRepository::class)]
class Compra
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $data_efetuada;

    #[ORM\Column(type: 'date', nullable: true)]
    private $data_finalizada;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $total;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'compras_do_usuario', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

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

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(?string $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
