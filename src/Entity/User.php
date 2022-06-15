<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 14)]
    private $cel;

    #[ORM\OneToOne(targetEntity: Endereco::class, cascade: ['persist', 'remove'])]
    private $endereco;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Compra::class)]
    private $compras_do_usuario;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    public function __construct()
    {
        $this->compras_do_usuario = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
     * @return Collection<int, Compra>
     */
    public function getComprasDoUsuario(): Collection
    {
        return $this->compras_do_usuario;
    }

    public function addComprasDoUsuario(Compra $comprasDoUsuario): self
    {
        if (!$this->compras_do_usuario->contains($comprasDoUsuario)) {
            $this->compras_do_usuario[] = $comprasDoUsuario;
            $comprasDoUsuario->setUserId($this);
        }

        return $this;
    }

    public function removeComprasDoUsuario(Compra $comprasDoUsuario): self
    {
        if ($this->compras_do_usuario->removeElement($comprasDoUsuario)) {
            // set the owning side to null (unless already changed)
            if ($comprasDoUsuario->getUserId() === $this) {
                $comprasDoUsuario->setUserId(null);
            }
        }

        return $this;
    }

    public function getCel(): ?string
    {
        return $this->cel;
    }

    public function setCel(string $cel): self
    {
        $this->cel = $cel;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
