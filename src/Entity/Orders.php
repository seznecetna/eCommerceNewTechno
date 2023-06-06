<?php

namespace App\Entity;

use App\Entity\Trait\CreatedDateTrait;
use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\DependencyInjection\Reference;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    use CreatedDateTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, unique: true)]
    private ?string $Reference = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?Coupons $Coupons = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $relation = null;

    #[ORM\OneToMany(mappedBy: 'Orders', targetEntity: OrderDetails::class, orphanRemoval: true)]
    private Collection $orderDetails;

    public function __construct()
    {
        $this->orderDetails = new ArrayCollection();
        $this->CreatedDate = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->Reference;
    }

    public function setReference(string $Reference): self
    {
        $this->Reference = $Reference;

        return $this;
    }

    public function getCoupons(): ?Coupons
    {
        return $this->Coupons;
    }

    public function setCoupons(?Coupons $Coupons): self
    {
        $this->Coupons = $Coupons;

        return $this;
    }

    public function getRelation(): ?Users
    {
        return $this->relation;
    }

    public function setRelation(?Users $relation): self
    {
        $this->relation = $relation;

        return $this;
    }

    /**
     * @return Collection<int, OrderDetails>
     */
    public function getOrderDetails(): Collection
    {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetails $orderDetail): self
    {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails->add($orderDetail);
            $orderDetail->setOrders($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetails $orderDetail): self
    {
        if ($this->orderDetails->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getOrders() === $this) {
                $orderDetail->setOrders(null);
            }
        }

        return $this;
    }
}
