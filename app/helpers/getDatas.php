<?php
include RUTA_APP . '/config/fbConfig.php';
include_once RUTA_APP.'/modele/Requete.php';

if(isset($accessToken)){
    if(isset($_SESSION['facebook_access_token'])){
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }else{
        // Token de acceso de corta duración en sesión
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        
          // Controlador de cliente OAuth 2.0 ayuda a administrar tokens de acceso
        $oAuth2Client = $fb->getOAuth2Client();
        
        // Intercambia una ficha de acceso de corta duración para una persona de larga vida
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        
        // Establecer token de acceso predeterminado para ser utilizado en el script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    
    // Redirigir el usuario de nuevo a la misma página si url tiene "code" parámetro en la cadena de consulta
    if(isset($_GET['code'])){
        header('Location: http://localhost:8080/PRUEBA/pages/accuil/');
    }
    
    // Obtener información sobre el perfil de usuario facebook
    try {
        $profileRequest = $fb->get('/me?fields=name,first_name,last_name,picture');
        $fbUserProfile = $profileRequest->getGraphNode()->asArray();
    } catch(FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();
        // Redirigir usuario a la página de inicio de sesión de la aplicación
        header("Location:http://localhost:8080/PRUEBA/");
        exit;
    } catch(FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    
    // Inicializar clase "user"
    $user = new Requete;
    
    // datos de usuario que iran a  la base de datos
    $fbUserData =[
        'oauth_provider'=> 'facebook',
        'oauth_uid'     => $fbUserProfile['id'],
        'first_name'    => $fbUserProfile['first_name'],
        'last_name'     => $fbUserProfile['last_name'],
        'picture'       => $fbUserProfile['picture']['url'],
    ];
    $userData = $user->checkUser($fbUserData);
    
    // Poner datos de usuario en variables de Session
    $_SESSION['userData'] = $userData;
    
    // Obtener el url para cerrar sesión
    $logoutURL = $helper->getLogoutUrl($accessToken, 'http://localhost:8080/PRUEBA/pages/fermer/');
    
    // imprimir datos de usuario
  
    if(!empty($userData)){
        $userInfo= 
        '<table class="table table-bordered"">
             <thead class="thead-dark" style="background: darkcyan;color: white; text-align: center;">
                  <tr><td colspan="2">BONJOUR MENSIEUR  '.$userData['first_name'].'</td></tr>
             </thead>
             <tbody>
                   <tr>
                     <td>petite image</td>
                     <td><img src='.$userData['picture'].'></td>
                   </tr>
                   <tr>
                     <td>login avec</td>
                     <td>Facebook</td>
                   </tr>
                   <tr>
                     <td>logaut</td>
                     <td><a class="btn btn-info" href="'.$logoutURL.'">Logaut Facebook</a></td>
                   </tr>
             </tbody>
         </table>';
    }
    $result=$user->getTodoUser();

        $donnees=[
            'users'=>$result
        ];
}

?>