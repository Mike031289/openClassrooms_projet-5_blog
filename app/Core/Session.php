<?php
namespace App\Core;

use App\Models\User;
use App\Manager\UserManager;

class Session
{
  private UserManager $userManager;
  
  /**
   * SessionManager constructor.
   *
   * Starts the session.
   */
  public function __construct(UserManager $userManager)
  {
    session_start();
    $this->userManager = $userManager;
  }

  public function connect(User $user, $userRole): void
  {
    // Set the user in the session
    $_SESSION['userEmail'] = $user->getEmail();

    // Set the user's role in the session
    $_SESSION['userRole'] = $userRole;
  }

  /**
   * Destroy the session.
   */
  public function destroy(): void
  {
    session_destroy();
  }

  /**
   * Check if a user is logged in (example method).
   *
   * @return bool True if the user is logged in, false otherwise.
   */
  public function isLoggedIn(): bool
  {
    return isset($_SESSION['userEmail']);
  }

  public function getUser(): ?User
  {
    if (!$this->isLoggedIn()){
      return null;
    }
    
    return $this->userManager->getUserByEmail($_SESSION['userEmail']);

  }

}