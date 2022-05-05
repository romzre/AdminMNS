<?php

// on vérifie que le formulaire a bien été soumis (l'email est  dans un input caché)
if(isset($_POST["email"]) && isset($_POST["submit"]) && ($_POST["action"]=="update"))
{
  //on récupère les champs du formulaire 
  $password1 = $_POST['password1'] ? $_POST['password1'] : NULL;
  $password2 = $_POST['password2'] ? $_POST['password2'] : NULL;
  $email = $_POST['email'];
  $curDate = date("Y-m-d H:i:s"); //dateCourante

  if(!$password1)
  {
    $error_password1="<p>Ce champ est obligatoire</p>";

  }
  if(!$password2)
  {
    $error_password2="<p>Ce champ est obligatoire</p>";

  }
  //on vérifie que les mots de passe sont identiques
  if (!empty($password1) && !empty($password2)) 
  {
    if ($password1!==$password2)
    {
      $error_passwords = "<p>Password do not match, both password should be same.</p>";
    }
    else 
    {
      //on récupère le mot de passe et on le met à jour dans la base en utilisant l'adresse email du user présente dans le input caché du formulaire
      $password = password_hash($password1, PASSWORD_DEFAULT);
      require '../app/Manager/UserManager.php';
      $userManager = new UserManager();
      $userManager->updatePassword($password, $email);

      //on supprime la clé unique qui a été créée suite à la demande de réinitialisation du user
      $passwordResetManager->deleteKey($email);
      $success = '<p>Congratulations! Your password has been updated successfully.</p>
      <p><a href="/?controller=security">
      Click here</a> to Login.</p>';
    }
  }
}