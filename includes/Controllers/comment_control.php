<?php
require_once(LIB_PATH.DS.'Helpers'.DS.'initialize.php');
class CommentControl{
    
    //comments retrieval method
    public function comments(){
        return Comment::find_comments_on($_GET['id']);
    }
     
    //function that inserts comments in the database through the model class
    public function save_comment($photo_id){
    if(isset($_POST['submit'])){
    $author = trim($_POST['author']);
    $body   = trim($_POST['body']);
    
    $new_comment = Comment::make($photo_id, $author, $body);
     if($new_comment && $new_comment->save()){
        //Send message
        $this->try_to_send_notification();
        
        //Important! You could just let the page render from here.
        //But then if the page is reloaded, the form will try
        //to resubmit the comment  . so redirect instead
        redirect_to("photo.php?id={$photo_id}");
        } else {
         //Failed
        $message = "There was an error that prevented the comment from being saved";
        return $message;
        }
    
    }
  }

  //function that handles delete command
    public function delete_comment(){
            if(isset($_GET['del_id'])){
                     $comment = Comment::find_by_id($_GET['del_id']);
                    if($comment && $comment->delete()){
                        $session = new Session();
                        $session->message("The comment was Deleted");
                        redirect_to("comments.php?id={$comment->photograph_id}");
                    } else {
                        $session->message("The comment could not be deleted");
                        redirect_to('list_photos.php');
                    }
            }

}   


  //function that sends mail notificaion
   public function try_to_send_notification(){
       $mail = new PHPMailer;

        $mail->SMTPDebug = 2;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = EMAIL;                 // SMTP username
        $mail->Password = PASS;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom(EMAIL, 'Photo Gallery'); // Sender
        $mail->addAddress('adurotimijoshua@gmail.com', 'Photo Gallery Admin');     // Add a recipient

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'A new Photo Gallery Comment:';
        $created = datetime_to_text($this->created);
        $mail->Body    =<<<EMAILBODY
A new comment has been recieved in the photo Gallery.
                
At {$created}, <b>{$this->author}<b> wrote: {$this->body}
   
EMAILBODY;
        $mail->AltBody = strip_tags("A new comment has been recieved in the photo Gallery.
                
        At {$created}, <b>{$this->author}<b> wrote: {$this->body}");

        if(!$mail->send()) {
            echo 'Notification could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Notification sent';
        }
        
       
   }
  
  
 }    