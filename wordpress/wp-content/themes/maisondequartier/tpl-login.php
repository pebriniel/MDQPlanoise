<?php
/*
Template Name: Connexion
*/
$error = false; 
if(!empty($_POST)){
    $user = wp_signon($_POST);
    if(is_wp_error($user)){
        $error = $user->get_error_message(); 
    }else{
        header('location:profil');
    }
}else{
    $user = wp_get_current_user();
    if($user->ID != 0){
        header('location:profil');
    }
}
?>
<?php get_header();?>

    <div class="single">
        <div class="post">
            <h1>Se connecter</h1>

            <?php if ($error): ?>
                <div class="error">
                    <?php echo $error; ?>
                </div>
            <?php endif ?>

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                <label for="user_login">Votre login</label>
                <input type="text" name="user_login" id="user_login"> 

                <label for="user_password">Votre mot de pass</label>
                <input type="text" name="user_password" id="user_password">

                <input type="checkbox" name="remember" id="remember" value="1">
                <label for="remember">Se souvenir de moi</label>

                <input type="submit" value="Se connecter">

            </form>

        </div>
    </div>

<?php get_footer(); ?>
