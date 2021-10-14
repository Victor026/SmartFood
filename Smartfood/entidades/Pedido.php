<?php

/**
 * Entidade do pedido
 */
class Pedido {

    /**
     * ID do pedido
     * @var integer
     */
     public $id;

    /**
    * Avaliação do pedido
    * @var float
    */
    public $avaliacao;

      /**
     * ID do restaurante responsável pelo pedido
     * @var integer
     */
     public $id_restaurante;

     /**
     * Data em que o pedido foi feito
     * @var date
     */
     public $data_pedido;

    /**
     * ID da sitação do pedido
     * @var int
     */
     public $id_situacao;

       /**
        * ID do usuário que fez o pedido
        * @var int
        */
        public $id_usuario;

        /**
         * Motivo pelo eventual cancelamento do pedido
         * @var string
         */
         public $motivo;

      /**
       * Método responsável por cadastrar o pedido
       * @return boolean
       */
       public function cadastrar() {
           $database = new Database('pedidos');
           $this->id = $database->insert([
                                 'id_usuario' => $this->id_usuario,
                                 'id_restaurante' => $this->id_restaurante,
                                 'id_situacao' => $this->id_situacao,
                                 'motivo' => $this->motivo,
                                 'data_pedido' => $this->data_pedido,
                                 'avaliacao' => $this->avaliacao,
                               ]);

       }

       /**
        * Método responsável por consultar os pedidos do banco
        * @param string $where
        * @param string $order
        * @param string $limit
        * @return Array [pedido]
        */
       public static function consultar( $where = null, $order = null, $limit = null ) {
         return (new Database('pedidos'))->select( $where, $order, $limit )
                                          ->fetchAll(PDO::FETCH_CLASS, self::class);
       }

       /**
        * Método responsável por consultar a quantidade de pedidos do banco
        * @param string $where
        * @return integer
        */
       public static function consultar_quantidade( $where = null ) {
         return (new Database('pedidos'))->select( $where, null, null, 'COUNT(*) as qtd' )
                                          ->fetchObject()
                                          ->qtd;
       }

       /**
        * Método responsável por consultar um pedido específico
        * @param string $email
        * @return pedido
        */
        public static function consultar_pedido( $id ) {
          return (new Database('pedidos'))->select('id = "'.$id.'" ')
                                           ->fetchObject(self::class);
        }

        /**
         * Método responsável por atualizar o pedido
         * @return boolean
         */
        public function atualizar(){
          return (new Database('pedidos'))->update( 'id = '.$this->id,
                                                    [
                                                      'id_usuario' => $this->id_usuario,
                                                      'id_restaurante' => $this->id_restaurante,
                                                      'id_situacao' => $this->id_situacao,
                                                      'motivo' => $this->motivo,
                                                      'data_pedido' => $this->data_pedido,
                                                      'avaliacao' => $this->avaliacao,
                                                  ]);
          }

        /**
         * Método responsável por excluir o pedido do banco
         * @return boolean
         */
        public function excluir(){
          return (new Database('pedidos'))->delete('id = '.$this->id);
        }


}
