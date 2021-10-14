<?php

include 'Usuario.php';

/**
 * Entidade do Restaurante
 */
class Restaurante extends Usuario{

    /**
     * ID do restaurante
     * @var integer
     */
     public $id;

    /**
    * Nome do restaurante
    * @var string
    */
    public $nome;

      /**
     * CNPJ do restaurante
     * @var integer
     */
     public $cnpj;

     /**
     * Estado do restaurante
     * @var string
     */
     public $estado;

    /**
     * Cidade do restaurante
     * @var string
     */
    public $cidade;

    /**
     * Rua do restaurante
     * @var string
     */
     public $rua;

    /**
     * Número do restaurante
     * @var integer
     */
     public $numero;

      /**
       * Avaliação do restaurante
       * @var date
       */
       public $avaliacao;

       /**
        * Descrição do restaurante
        * @var string
        */
        public $descricao;

        /**
         * Email do restaurante
         * @var string
         */
         public $email;

        /**
         * Telefone do restaurante
         * @var string
         */
         public $telefone;

      /**
       * Método responsável por cadastrar o restaurante
       * @return boolean
       */
       public function cadastrar() {
           $database = new Database('restaurantes');
           $this->id = $database->insert([
                                 'nome' => $this->nome,
                                 'email' => $this->email,
                                 'cnpj' => $this->cnpj,
                                 'descricao' => $this->descricao,
                                 'estado' => $this->estado,
                                 'cidade' => $this->cidade,
                                 'rua' => $this->rua,
                                 'numero' => $this->numero,
                                 'avaliacao' => $this->avaliacao,
                                 'telefone' => $this->telefone,
                               ]);

       }

       /**
        * Método responsável por consultar os restaurantes do banco
        * @param string $where
        * @param string $order
        * @param string $limit
        * @return Array [restaurante]
        */
       public static function consultar( $where = null, $order = null, $limit = null ) {
         return (new Database('restaurantes'))->select( $where, $order, $limit )
                                          ->fetchAll(PDO::FETCH_CLASS, self::class);
       }

       /**
        * Método responsável por consultar a quantidade de restaurantes do banco
        * @param string $where
        * @return integer
        */
       public static function consultar_quantidade( $where = null ) {
         return (new Database('restaurantes'))->select( $where, null, null, 'COUNT(*) as qtd' )
                                          ->fetchObject()
                                          ->qtd;
       }

       /**
        * Método responsável por consultar um restaurante específico
        * @param string $id
        * @return restaurante
        */
        public static function consultar_restaurante( $id ) {
          return (new Database('restaurantes'))->select('id = "'.$id.'" ')
                                           ->fetchObject(self::class);
        }

        /**
         * Método responsável por consultar um restaurante específico pelo email
         * @param string $email
         * @return restaurante
         */
         public static function consultar_restaurante_email( $email ) {
           return (new Database('restaurantes'))->select('email = "'.$email.'" ')
                                            ->fetchObject(self::class);
         }


        /**
         * Método responsável por atualizar o corretor no banco
         * @return boolean
         */
        public function atualizar(){
          return (new Database('restaurantes'))->update( 'id = '.$this->id,
                                                    [
                                                      'nome' => $this->nome,
                                                      'nome' => $this->email,
                                                      'cnpj' => $this->cnpj,
                                                      'descricao' => $this->descricao,
                                                      'estado' => $this->estado,
                                                      'cidade' => $this->cidade,
                                                      'rua' => $this->rua,
                                                      'numero' => $this->numero,
                                                      'avaliacao' => $this->avaliacao,
                                                      'telefone' => $this->telefone,
                                                  ]);
          }

        /**
         * Método responsável por excluir o restaurante do banco
         * @return boolean
         */
        public function excluir(){
          return (new Database('restaurantes'))->delete('id = '.$this->id);
        }


}
