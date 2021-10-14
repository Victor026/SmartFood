<?php

/**
 * Entidade da mensagem
 */
class Mensagem {

    /**
     * ID da mensagem
     * @var integer
     */
     public $id;

    /**
    * ID do usuário origem
    * @var integer
    */
    public $id_origem;

    /**
     * ID do usuário destino
     * @var integer
     */
     public $id_destino;

     /**
      * ID do pedido da mensagem
      * @var integer
      */
      public $id_pedido;

      /**
       * Data em que foi enviada a mensagem
       * @var date
       */
       public $data_mensagem;

     /**
     * Conteúdo da mensagem
     * @var string
     */
     public $mensagem;

      /**
       * Método responsável por cadastrar a mensagem
       * @return boolean
       */
       public function cadastrar() {
           $database = new Database('mensagens');
           $this->id = $database->insert([
                                 'id_origem' => $this->id_origem,
                                 'id_destino' => $this->id_destino,
                                 'id_pedido' => $this->id_pedido,
                                 'data_mensagem' => $this->data_mensagem,
                                 'mensagem' => $this->mensagem,
                               ]);

       }

       /**
        * Método responsável por consultar os mensagens do banco
        * @param string $where
        * @param string $order
        * @param string $limit
        * @return Array [mensagem]
        */
       public static function consultar( $where = null, $order = null, $limit = null ) {
         return (new Database('mensagens'))->select( $where, $order, $limit )
                                          ->fetchAll(PDO::FETCH_CLASS, self::class);
       }

       /**
        * Método responsável por consultar a quantidade de mensagens do banco
        * @param string $where
        * @return integer
        */
       public static function consultar_quantidade( $where = null ) {
         return (new Database('mensagens'))->select( $where, null, null, 'COUNT(*) as qtd' )
                                          ->fetchObject()
                                          ->qtd;
       }

       /**
        * Método responsável por consultar uma mensagem específica
        * @param string $email
        * @return mensagem
        */
        public static function consultar_mensagem( $id ) {
          return (new Database('mensagens'))->select('id = "'.$id.'" ')
                                           ->fetchObject(self::class);
        }

        /**
         * Método responsável por atualizar a mensagem
         * @return boolean
         */
        public function atualizar(){
          return (new Database('mensagens'))->update( 'id = '.$this->id,
                                                    [
                                                      'id_origem' => $this->id_origem,
                                                      'id_destino' => $this->id_destino,
                                                      'id_pedido' => $this->id_pedido,
                                                      'data_mensagem' => $this->data_mensagem,
                                                      'mensagem' => $this->mensagem,
                                                  ]);
          }

        /**
         * Método responsável por excluir a mensagem do banco
         * @return boolean
         */
        public function excluir(){
          return (new Database('mensagens'))->delete('id = '.$this->id);
        }


}
