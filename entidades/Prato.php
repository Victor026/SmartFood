<?php

/**
 * Entidade do prato
 */
class Prato {

    /**
     * ID do prato
     * @var integer
     */
     public $id;

    /**
    * Nome do prato
    * @var string
    */
    public $nome;

      /**
     * ID do restaurante responsável pelo prato
     * @var integer
     */
     public $id_restaurante;

     /**
     * Pedido que contém o prato
     * @var integer
     */
     public $pedido;

    /**
     * Preço do prato
     * @var float
     */
     public $preco;

      /**
       * Avaliação do prato
       * @var date
       */
       public $avaliacao;

       /**
        * Descrição do prato
        * @var string
        */
        public $descricao;

      /**
       * Método responsável por cadastrar o prato
       * @return boolean
       */
       public function cadastrar() {
           $database = new Database('pratos');
           $this->id = $database->insert([
                                 'nome' => $this->nome,
                                 'id_restaurante' => $this->id_restaurante,
                                 'pedido' => $this->pedido,
                                 'preco' => $this->preco,
                                 'descricao' => $this->descricao,
                                 'avaliacao' => $this->avaliacao,
                               ]);

       }

       /**
        * Método responsável por consultar os pratos do banco
        * @param string $where
        * @param string $order
        * @param string $limit
        * @return Array [prato]
        */
       public static function consultar( $where = null, $order = null, $limit = null ) {
         return (new Database('pratos'))->select( $where, $order, $limit )
                                          ->fetchAll(PDO::FETCH_CLASS, self::class);
       }

       /**
        * Método responsável por consultar a quantidade de pratos do banco
        * @param string $where
        * @return integer
        */
       public static function consultar_quantidade( $where = null ) {
         return (new Database('pratos'))->select( $where, null, null, 'COUNT(*) as qtd' )
                                          ->fetchObject()
                                          ->qtd;
       }

       /**
        * Método responsável por consultar um prato específico
        * @param string $email
        * @return prato
        */
        public static function consultar_prato( $id ) {
          return (new Database('pratos'))->select('id = "'.$id.'" ')
                                           ->fetchObject(self::class);
        }

        /**
         * Método responsável por atualizar o corretor no banco
         * @return boolean
         */
        public function atualizar(){
          return (new Database('pratos'))->update( 'id = '.$this->id,
                                                    [
                                                      'nome' => $this->nome,
                                                      'id_restaurante' => $this->id_restaurante,
                                                      'pedido' => $this->pedido,
                                                      'preco' => $this->preco,
                                                      'descricao' => $this->descricao,
                                                      'avaliacao' => $this->avaliacao,
                                                  ]);
          }

        /**
         * Método responsável por excluir o prato do banco
         * @return boolean
         */
        public function excluir(){
          return (new Database('pratos'))->delete('id = '.$this->id);
        }


}
