<?php
namespace App\Models;

/**
 * Class Contact
 *
 * Represents a contact in your application.
 */
class Contact
{

  private int $id;

  /**
   * @var string|null The name of the contact.
   */
  private string $name;

  /**
   * @var string|null The user's email address.
   */
  private string $email;

  /**
   * @var string|null The contact message.
   */
  private string $message;

  private \DateTime $sendAt;

  /**
   * Contact constructor.
   *
   * @param $id      The contact's ID.
   * @param $name    The name of the contact.
   * @param $email   The user's email address.
   * @param $message The contact message.
   */
  public function __construct(int $id, string $name, string $email, string $message)
  {
    $this->id      = $id;
    $this->name    = $name;
    $this->email   = $email;
    $this->message = $message;
    $this->sendAt  = new \DateTime();
  }

  /**
   * Get the value of id
   */
  public function getId(): int
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @param int $id The contact's ID.
   * @return self
   */
  public function setId(int $id): self
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the name of the contact.
   *
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * Set the name of the contact.
   *
   * @param string $name The name of the contact.
   * @return self
   */
  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the user's email address.
   *
   * @return string|null The user's email address.
   */
  public function getEmail(): ?string
  {
    return $this->email;
  }

  /**
   * Set the user's email address.
   *
   * @param string|null $email The user's email address.
   * @return self
   */
  public function setEmail(?string $email): self
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get the value of message
   *
   * @return string
   */
  public function getMessage(): string
  {
    return $this->message;
  }

  /**
   * Set the value of message
   *
   * @param string $message The contact message.
   * @return self
   */
  public function setMessage(string $message): self
  {
    $this->message = $message;

    return $this;
  }

  /**
   * Get the value of sendAt
   *
   * @return \DateTime The date and time the message was sent.
   */
  public function getSendAt(): \DateTime
  {
    return $this->sendAt;
  }

  /**
   * Set the value of sendAt
   *
   * @param \DateTime $sendAt The date and time the message was sent.
   * @return self
   */
  public function setSendAt(\DateTime $sendAt): self
  {
    $this->sendAt = $sendAt;

    return $this;
  }
}
