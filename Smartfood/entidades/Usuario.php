<?php

/**
 * Usuário logado no sistema
 */
class Usuario {

    /**
     * ID do usuário
     * @var integer
     */
     public $id;

    /**
    * Nome do usuário
    * @var string
    */
    public $nome;

    /**
     * Email do usuário
     * @var string
     */
     public $email;

     /**
      * Senha do usuário
      * @var string
      */
      public $senha;
	  
	  /**
      * Cpf do usuário
      * @var integer
      */
      public $cpf;

     /**
     * Telefone do usuário
     * @var string
     */
     public $telefone;

     /**
     * Telefone do usuário
     * @var integer
     */
     public $acesso;

      /**
       * Método para cadastrar usuário
       * @return boolean
       */
       public function cadastrar() {
           $database = new Database('usuarios');
           $this->id = $database->insert([
                                 'nome' => $this->nome,
                                 'email' => $this->email,
                                 'senha' => $this->senha,
								 'cpf' => $this->cpf,
                                 'telefone' => $this->telefone,
                                 'acesso' => $this->acesso,
                               ]);

       }

       /**
        * Método para consultar usuário
        * @param string $values
        * @param string $values
        * @param string $values
        * @return array
        */
        public static function consultar( $where = null, $order = null, $limit = null ) {
          return (new Database('usuarios'))->select( $where, $order, $limit )
                                           ->fetchAll(PDO::FETCH_CLASS, self::class);
        }

       /**
        * Método para consultar usuário específico
        * @param string
        * @return Usuario
        */
        public static function consultar_usuario( $email ) {
          return (new Database('usuarios'))->select('email = "'.$email.'" ')
                                           ->fetchObject(self::class);
        }

        /**
         * Método para consultar usuário específico
         * @param string
         * @return Usuario
         */
         public static function consultar_usuario_id( $id ) {
           return (new Database('usuarios'))->select('id = "'.$id.'" ')
                                            ->fetchObject(self::class);
         }

         /**
          * Método responsável por consultar a quantidade de corretores do banco
          * @param string $where
          * @return integer
          */
         public static function consultar_quantidade( $where = null ) {
           /* return (new Database('usuarios'))->select( $where, null, null, 'COUNT(*) as qtd' )
                                            ->fetchObject()
                                            ->qtd; */
                                            return;
         }

        /**
         * Método responsável por atualizar o corretor no banco
         * @return boolean
         */
        public function atualizar(){
          return (new Database('usuarios'))->update( 'id = '.$this->id,
                                                    [
                                                      'nome' => $this->nome,
                                                      'email' => $this->email,
                                                      'senha' => $this->senha,
                                                      'telefone' => $this->telefone,
                                                      'acesso' => $this->acesso,
                                                  ]);
}

  /**
   * Método responsável por excluir o usuário do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('usuarios'))->delete('id = '.$this->id);
  }


}
