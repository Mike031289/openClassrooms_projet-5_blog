<?php

declare(strict_types=1);

namespace App\Manager;

use App\Exceptions\ActionNotFoundException;
use App\Models\Contact;

class ContactManager extends BaseManager
{
    public function __construct(object $dataSource)
    {
        parent::__construct('contact', 'Contact', $dataSource);
    }

    /**
     * Create a new contact and insert it into the database.
     *
     * @param $userName The name or company name of the contact
     * @param $email    The email address of the contact
     * @param $message  The message content from the contact
     *
     * @return Contact|null the created Contact object, or null on failure
     */
    public function createContact(string $userName, string $email, string $message): ?Contact
    {
        $this->_db->beginTransaction();

        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('Europe/Paris')); // Set the timezone if necessary
        $createdAt = $date->format('Y-m-d H:i:s');

        try {
            // Step 2: Insert the contact into the 'Contact' table
            $sql = 'INSERT INTO Contact (name, email, message, createdAt) VALUES (?, ?, ?, ?)';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(1, $userName, \PDO::PARAM_STR);
            $stmt->bindParam(2, $email, \PDO::PARAM_STR);
            $stmt->bindParam(3, $message, \PDO::PARAM_STR);
            $stmt->bindParam(4, $createdAt, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                throw new ActionNotFoundException();
            }

            // Commit the transaction
            $this->_db->commit();

            // Get the ID of the inserted contact
            $id = $this->_db->lastInsertId();

            // Create a new Contact object with the inserted data
            $contact = new Contact();
            $contact->setId((int) $id);
            $contact->setUserName(htmlspecialchars($userName));
            $contact->setEmail(htmlspecialchars($email));
            $contact->setMessage(htmlspecialchars($message));
            $contact->setCreatedAt(new \DateTime($createdAt));

            return $contact;
        } catch (ActionNotFoundException $e) {
            // Handle the error in case of failure and roll back the transaction
            // Redirect to a 500 error page if no matching route is found
            header('Location: 500');
            $this->_db->rollBack();

            return null;
        }
    }

    /**
     * Retrieves the total number of contacts in the 'Contact' table.
     *
     * @return int|null the total number of contacts
     * @throws ActionNotFoundException If an error occurs during the database query
     */
    private function getTotalContacts(): ?int
    {
        try {

        // Retrieve the total number of contacts
        $sql = 'SELECT COUNT(*) FROM Contact';
        $stmt = $this->_db->query($sql);

            if ($stmt === false) {
                throw new ActionNotFoundException();
            }

            return (int) $stmt->fetchColumn();
        }
        catch (ActionNotFoundException $e) {
            // Handle exceptions, log errors, or redirect to your custom error page
            header('Location: /../mon-blog/500');
            
            return null;
        }
    }

    /**
     * Retrieves a paginated list of contacts.
     *
     * @param int $page    The current page number (default is 1)
     * @param int $perPage The number of contacts per page
     *
     * @return array<string, mixed>|null an array containing contacts and pagination information
     */
    public function getPaginatedContacts(int $page, int $perPage): ?array
    {
        if ($page < 1) {
            $page = 1;
        }
        // Calculate the offset based on the page number and items per page
        $offset = ($page - 1) * $perPage;

        // Initialize the $contacts array
        $contacts = [];

        try {
            // Retrieve the total number of contacts
            $totalContacts = $this->getTotalContacts();

            // Retrieve contacts from the 'Contact' table, ordered by date in descending order, with pagination
            $sql  = 'SELECT * FROM Contact ORDER BY createdAt DESC LIMIT :offset, :perPage';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
            $stmt->bindParam(':perPage', $perPage, \PDO::PARAM_INT);
            $stmt->execute();

            // Use setFetchMode to specify the class and fetch mode
            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Contact::class, []);

            // Fetch the results as an Object in array
            $contactsData = $stmt->fetchAll(\PDO::FETCH_OBJ);

            // Convert the data into an array of Contact objects
            foreach ($contactsData as $data) {
                $contact = new Contact();
                $contact->setId($data->id);
                $contact->setUserName($data->name);
                $contact->setEmail($data->email);
                $contact->setMessage($data->message);
                $contact->setCreatedAt(new \DateTime($data->createdAt));

                $contacts[] = $contact;
            }

            // Return an array with contacts and pagination information
            return [
                'contacts'    => $contacts,
                'currentPage' => $page,
                'totalPages'  => ceil($totalContacts / $perPage),
            ];
        }
        catch (ActionNotFoundException $e) {
            // Handle exceptions, log errors, or return an empty array
            // Redirect to an admin 500 error page if an exception occurs
            header('Location: /../mon-blog/500');

            return null;
        }
    }

}
