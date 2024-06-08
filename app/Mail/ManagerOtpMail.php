<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ManagerOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    //ATTRIBUT DE LA CLASSE
    public $get_user_email;
    public $validToken;
    public $get_user_name;

    //INITIALISATION DU CONTROLLER POUR PRENDRE EN PARAMETRE LE NOM, L'EMAIL DE L'UTILISATEUR ET LE TOKEN CREER.
    public function __construct($get_user_email, $validToken, $get_user_name)
    {
        $this->get_user_email = $get_user_email;
        $this->validToken = $validToken;
        $this->get_user_name = $get_user_name;
    }

    

    //LA METHODE BUILD PERMET EN QUELQUE SORTE DE CONSTRUIRE LE MAIL
    //C'EST ICI QU'ON PRECISE A QUI ENVOYER LE MAIL, L'OBJET ET LE CONTENU DU MAIL
    //DANS NOTRE CAS LE CONTENU DU MAIL SERA UN FICHIER HTML BIEN DESIGNER
    public function build()
    {
        //ICI ON RECUPERE LA ROUTE NOMME validate_token
        $verificationUrl = route('validate_token', ['token' => $this->validToken]);

        return $this->view('emails.admins.otp')
                    ->subject('Verifiez votre comptre PLANIFY')
                    ->with([
                        'verificationUrl' => $verificationUrl,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verifiez votre comptre PLANIFY',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        //COMME LE CONTENU DE NOTRE MAIL SERA UN FICHIER BLADE, ICI ON SPECIFIE L'EMPLACEMENT DU FICHIER
        return new Content(
            view: 'emails.managers.auth.otp',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        //ICI C'EST POUR PRECISER LE CHEMIN VERS LES PIECES JOINTES A ENVOYER MAIS NOUS ON VEUX JUSTE ENVOYER UN OTP.
        return [];
    }
}
