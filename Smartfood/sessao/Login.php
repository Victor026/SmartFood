<?php

/**
 * Classe para gerenciar a sessão do usuário
 */
class Login {

  /**
   * Pega o usuário logado
   * @return $_SESSION
   */
   public static function get_usuario_logado() {
     self::init();
     return self::isLogged() ? $_SESSION['usuario'] : null;
   }

  /**
   * Inicia a sessão
   */
   private static function init() {
     if ( session_status() !== PHP_SESSION_ACTIVE ) {
       session_start();
     }
   }

   /**
    * Loga o usuário no sistema
    * @param Usuario
    */
    public static function logar( $usuario, $senha_pura ) {
      self::init();
      // Atribui as variávais à sessão
      $_SESSION['usuario'] = [
        'id' => $usuario->id,
        'email' => $usuario->email,
        'nome' => $usuario->nome,
        'telefone' => $usuario->telefone,
        'acesso' => $usuario->acesso,
        'pedido' => array(),
      ];

      if ($usuario->acesso == 'u') {
        // Redireciona pra página inicial do cliente
          header('location:pag-inicial-adm');
      } else {
        // Redireciona pra página inicial do cliente
          header('location:pag-inicial-res.php');
      }


    }

    /**
     * Método para deslogar o usuário
     */
     public function deslogar() {
       self::init();
       unset($_SESSION['usuario']);
       header('location: index.php');
     }

  /**
   * Verifica se o usuário está logado
   * @return boolean
   */
   public static function isLogged() {
     self::init();
     return isset($_SESSION['usuario']['id']);
   }

   /**
    * Requere que o usuário esteja logado
    */
    public static function requireLogin() {
      if (!self::isLogged()) {
        header('location: index.php');
        exit;
      }
    }

    /**
     * Requere que o usuário não esteja deslogado
     */
     public static function requireLogout() {
       if (self::isLogged()) {
         header('location: pag-inicial-adm.php');
         exit;
       }
     }

}
