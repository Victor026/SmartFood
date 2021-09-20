<?php

/**
 * Entidade do prato
 */
class Prato_Pedido {

    /**
     * ID do prato x pedido
     * @var integer
     */
     public $id;

    /**
    * ID do pedido
    * @var int
    */
    public $id_pedido;

    /**
     * ID do prato
     * @var integer
     */
     public $id_prato;

    /**
    * Quantidade do prato
    * @var integer
    */
    public $qtd_prato;

      /**
       * Método responsável por cadastrar o prato x pedido
       * @return boolean
       */
       public function cadastrar() {
           $database = new Database('prato_pedido');
           $this->id = $database->insert([
                                 'id_pedido' => $this->id_pedido,
                                 'qtd_prato' => $this->qtd_prato,
                                 'id_prato' => $this->id_prato,
                               ]);

       }

       /**
        * Método responsável por consultar os prato_pedido do banco
        * @param string $where
        * @param string $order
        * @param string $limit
        * @return Array [prato]
        */
       public static function consultar( $where = null, $order = null, $limit = null ) {
         return (new Database('prato_pedido'))->select( $where, $order, $limit )
                                          ->fetchAll(PDO::FETCH_CLASS, self::class);
       }

       /**
        * Método responsável por consultar a quantidade de prato_pedido do banco
        * @param string $where
        * @return integer
        */
       public static function consultar_quantidade( $where = null ) {
         return (new Database('prato_pedido'))->select( $where, null, null, 'COUNT(*) as qtd' )
                                          ->fetchObject()
                                          ->qtd;
       }

       /**
        * Método responsável por consultar um prato específico
        * @param string $email
        * @return prato
        */
        public static function consultar_prato( $id ) {
          return (new Database('prato_pedido'))->select('id = "'.$id.'" ')
                                           ->fetchObject(self::class);
        }

        /**
         * Método responsável por atualizar o corretor no banco
         * @return boolean
         */
        public function atualizar(){
          return (new Database('prato_pedido'))->update( 'id = '.$this->id,
                                                    [
                                                      'id_pedido' => $this->id_pedido,
                                                      'qtd_prato' => $this->id_prato,
                                                      'id_prato' => $this->id_prato,
                                                  ]);
          }

        /**
         * Método responsável por excluir o prato x pedido do banco
         * @return boolean
         */
        public function excluir(){
          return (new Database('prato_pedido'))->delete('id = '.$this->id);
        }


}
