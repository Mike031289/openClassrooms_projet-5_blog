<?php

declare(strict_types=1);

namespace App\Core;

use App\Manager\UserManager;
use App\Models\User;

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

    /**
     * Connects the user and sets session information.
     *
     * @param $user     The user object
     * @param $userRole The role of the user
     */
    public function connect(User $user, string $userRole): void
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
     * @return bool true if the user is logged in, false otherwise
     */
    public function isLoggedIn(): bool
    {
        return isset($_SESSION['userEmail']);
    }

    /**
     * Retrieves the user object if logged in.
     *
     * @return User|null the user object, or null if not logged in
     */
    public function getUser(): ?User
    {
        if (!$this->isLoggedIn()) {
            return null;
        }

        return $this->userManager->getUserByEmail($_SESSION['userEmail']);
    }

    /**
     * Retrieves the role of the logged-in user.
     *
     * @return string the role of the user
     */
    public function getUserRole(): ?string
    {
        if (!$this->isLoggedIn()) {
            return ''; // Assuming an empty string is appropriate for an unauthenticated user
        }

        return $this->userManager->getUserRoleByEmail($_SESSION['userEmail']);
    }

}
