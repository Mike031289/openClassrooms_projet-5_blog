<?php

namespace App\Models;

/**
 * Class Category
 *
 * Represents a category entity.
 */
class Category
{
    /** @var int|null The unique identifier for the category. */
    private ?int $id;

    /** @var string|null The name of the category. */
    private ?string $name;

    /**
     * Get the value of id.
     *
     * @return int|null The category ID.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id.
     *
     * @param int $id The category ID.
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name.
     *
     * @return string|null The category name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name.
     *
     * @param string $name The category name.
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
