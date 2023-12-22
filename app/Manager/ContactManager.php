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
            $contact->setId($id);
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
     * @return int the total number of contacts
     */
    private function getTotalContacts(): int
    {
        // Retrieve the total number of contacts
        $sql = 'SELECT COUNT(*) FROM Contact';
        $stmt = $this->_db->query($sql);

        return $stmt->fetchColumn();
    }

    /**
     * Retrieves a paginated list of contacts.
     *
     * @param $page    The current page number (default is 1)
     * @param $perPage The number of contacts per page
     *
     * @return array an array containing contacts and pagination information
     */
    public function getPaginatedContacts(int $page, int $perPage): ?array
    {
        if ($page < 1) {
            $page = 1;
        }
        // Calculate the offset based on the page number and items per page
        $offset = ($page - 1) * $perPage;

        try {
            // Retrieve the total number of contacts
            $totalContacts = $this->getTotalContacts();

            // Retrieve contacts from the 'Contact' table, ordered by date in descending order, with pagination
            $sql = 'SELECT * FROM Contact ORDER BY createdAt DESC LIMIT :offset, :perPage';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
            $stmt->bindParam(':perPage', $perPage, \PDO::PARAM_INT);
            $stmt->execute();

            // Use setFetchMode to specify the class and fetch mode
            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Contact::class);

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
        } catch (ActionNotFoundException $e) {
            // Handle exceptions, log errors, or return an empty array
            // Redirect to an admin 500 error page if an exception occurs
<<<<<<< HEAD
            header('Location: 500');
            exit;
        }
    }

    // public function sendMail($userName, $email, $message): void
    // {
    //     // Création de l'objet PHPMailer
    //     $mail = new PHPMailer(true);

    //     try {
    //         // Configuration de l'envoi via SMTP
    //         $mail->isSMTP();
    //         $mail->Host       = "localhost";
    //         $mail->SMTPAuth   = false;
    //         $mail->Username   = "root";
    //         $mail->Password   = "";
    //         $mail->SMTPSecure = "";
    //         $mail->Port       = 25;

    //         // Configuration du charset
    //         $mail->CharSet = "utf-8";

    //         // Ajout des destinataires
    //         $mail->addAddress("mike.agbelou@gmail.com");

    //         // Configuration de l'expéditeur
    //         $mail->setFrom("adjoukou-agbelou-blog@mon-blog.fr");

    //         // Configuration du contenu du message
    //         $mail->isHTML();
    //         $mail->Subject = "Contact venant de mon Blog";
    //         $mail->Body    =
    //             "Bonjour, <br>
    //         <p> Un utilisateur vient de vous envoyer un message via votre Blog.</p>
    //         <p> <strong> Nom & Prénoms ou Raison sociale : </strong> $userName</p>
    //         <p> <strong> Email : </strong> $email</p>
    //         <p> <strong> Contenu du message : </strong> $message </p>
    //         <p> Cordialement, </p>
    //         <p> Ce message est automatique depuis votre Blog </p>
    //         <h4>
    //             <img src='href='public/assets/img/logo.png' alt='Logo du Blog'>
    //         </h4>";

    //         // Corps alternatif du message (texte brut)
    //         $mail->AltBody = "Bonjour,
    //     Un utilisateur vient de vous envoyer un message via votre Blog.
    //     Nom & Prénoms ou Raison sociale : $userName
    //     Email :  $email
    //     Contenu du message : $message
    //     Cordialement,
    //     Ce message est automatique depuis votre Blog";

    //         // Envoi du mail
    //         $mail->send();
    //     }
    //     catch (Exception $e) {
    //         echo "Message non envoyé. Erreur: {$e->getMessage()}";
    //     }
    // }
}
=======
            header("Location: 500");
        }
    }
}
>>>>>>> debug-branch
