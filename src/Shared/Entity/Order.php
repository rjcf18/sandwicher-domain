<?php declare(strict_types=1);
namespace Sandwicher\Domain\Shared\Entity;

use DateTimeImmutable;
use Sandwicher\Domain\Shared\ValueObject\BreadSize;
use Sandwicher\Domain\Shared\ValueObject\BreadType;
use Sandwicher\Domain\Shared\ValueObject\ExtraIngredient;
use Sandwicher\Domain\Shared\ValueObject\Sauce;
use Sandwicher\Domain\Shared\ValueObject\Vegetable;

class Order
{
    private int $id;

    private Meal $meal;

    private Consumer $consumer;

    private bool $ovenBaked;

    private BreadType $breadType;

    private BreadSize $breadSize;

    private ExtraIngredient $extraIngredient;

    private Vegetable $vegetable;

    private Sauce $sauce;

    private DateTimeImmutable $createdAt;

    private DateTimeImmutable $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getMeal(): Meal
    {
        return $this->meal;
    }

    public function setMeal(Meal $meal): self
    {
        $this->meal = $meal;

        return $this;
    }

    public function getConsumer(): Consumer
    {
        return $this->consumer;
    }

    public function setConsumer(Consumer $consumer): self
    {
        $this->consumer = $consumer;

        return $this;
    }

    public function isOvenBaked(): bool
    {
        return $this->ovenBaked;
    }

    public function setOvenBaked(bool $ovenBaked): self
    {
        $this->ovenBaked = $ovenBaked;

        return $this;
    }

    public function getBreadType(): BreadType
    {
        return $this->breadType;
    }

    public function setBreadType(BreadType $breadType): self
    {
        $this->breadType = $breadType;

        return $this;
    }

    public function getBreadSize(): BreadSize
    {
        return $this->breadSize;
    }

    public function setBreadSize(BreadSize $breadSize): self
    {
        $this->breadSize = $breadSize;

        return $this;
    }

    public function getExtraIngredient(): ExtraIngredient
    {
        return $this->extraIngredient;
    }

    public function setExtraIngredient(ExtraIngredient $extraIngredient): self
    {
        $this->extraIngredient = $extraIngredient;

        return $this;
    }

    public function getVegetable(): Vegetable
    {
        return $this->vegetable;
    }

    public function setVegetable(Vegetable $vegetable): self
    {
        $this->vegetable = $vegetable;

        return $this;
    }

    public function getSauce(): Sauce
    {
        return $this->sauce;
    }

    public function setSauce(Sauce $sauce): self
    {
        $this->sauce = $sauce;

        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}