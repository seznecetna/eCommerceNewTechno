<?php

namespace App\Entity;

use App\Entity\Trait\CreatedDateTrait;
use App\Repository\CouponsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponsRepository::class)]
class Coupons
{
    use CreatedDateTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10, unique: true)]
    private ?string $code = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\Column]
    private ?int $Discount = null;

    #[ORM\Column]
    private ?int $MaxUsage = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Validity = null;

    #[ORM\Column]
    private ?bool $IsValid = null;


    #[ORM\ManyToOne(inversedBy: 'coupons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CouponTypes $CouponsTypes = null;

    #[ORM\OneToMany(mappedBy: 'Coupons', targetEntity: Orders::class)]
    private Collection $Users;

    public function __construct()
    {
        $this->Users = new ArrayCollection();
        $this->CreatedDate = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->Discount;
    }

    public function setDiscount(int $Discount): self
    {
        $this->Discount = $Discount;

        return $this;
    }

    public function getMaxUsage(): ?int
    {
        return $this->MaxUsage;
    }

    public function setMaxUsage(int $MaxUsage): self
    {
        $this->MaxUsage = $MaxUsage;

        return $this;
    }

    public function getValidity(): ?\DateTimeInterface
    {
        return $this->Validity;
    }

    public function setValidity(\DateTimeInterface $Validity): self
    {
        $this->Validity = $Validity;

        return $this;
    }

    public function isIsValid(): ?bool
    {
        return $this->IsValid;
    }

    public function setIsValid(bool $IsValid): self
    {
        $this->IsValid = $IsValid;

        return $this;
    }

    public function getCouponsTypes(): ?CouponTypes
    {
        return $this->CouponsTypes;
    }

    public function setCouponsTypes(?CouponTypes $CouponsTypes): self
    {
        $this->CouponsTypes = $CouponsTypes;

        return $this;
    }

    /**
     * @return Collection<int, Orders>
     */
    public function getUsers(): Collection
    {
        return $this->Users;
    }

    public function addUser(Orders $user): self
    {
        if (!$this->Users->contains($user)) {
            $this->Users->add($user);
            $user->setCoupons($this);
        }

        return $this;
    }

    public function removeUser(Orders $user): self
    {
        if ($this->Users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCoupons() === $this) {
                $user->setCoupons(null);
            }
        }

        return $this;
    }
}
