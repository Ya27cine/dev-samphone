<?php
namespace App\Notification;
use App\Entity\Contact;
use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport;
use Twig\Environment;

class ContactNotif{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $render;
    /**
     * @var GmailSmtpTransport
     */
    private $smtpTransport;

    public function __construct(\Swift_Mailer $mailer, Environment $render)
    {
        $this->mailer = $mailer;
        $this->render = $render;
    }

    public function Notify(Contact $contact){
          $msg = (new \Swift_Message("Samphone Reparation : ".
                     $contact->getProduit()->getTitre()))
              ->setFrom("samphone.print@gmail.com")
              ->setTo("samphone.print@gmail.com")
              ->setReplyTo("prostam27@gmail.com")
              ->setBody($this->getRender()->render('email/contact.html.twig',[
                  'contact' => $contact
                  ]), 'text/html');

          $this->getMailer()->send($msg);
    }

    /**
     * @return \Swift_Mailer
     */
    public function getMailer(): \Swift_Mailer
    {
        return $this->mailer;
    }

    /**
     * @param \Swift_Mailer $mailer
     */
    public function setMailer(\Swift_Mailer $mailer): void
    {
        $this->mailer = $mailer;
    }

    /**
     * @return Environment
     */
    public function getRender(): Environment
    {
        return $this->render;
    }

    /**
     * @param Environment $render
     */
    public function setRender(Environment $render): void
    {
        $this->render = $render;
    }


}
?>