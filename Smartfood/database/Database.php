<?php

/**
 * Classe do BDD
 */

class Database {

  /**
   * Host do BDD
   * @var string
   */
   const HOST = 'localhost';

   /**
    * Nome do BDD
    * @var string
    */
    const DBNAME = 'smartfood';

    /**
     * Usuário do BDD
     * @var string
     */
     const USER = 'root';

     /**
      * Senha do BDD
      * @var string
      */
      const PASSWORD = '';

    /**
     * Conexão do BDD
     * @var PDO
     */
     public $conexao;

    /**
     * Tabela sendo usada
     * @var string
     */
     public $tabela;

  /**
   * Descrição do método
   * @param string $tabela
   */
 public function __construct( $tabela ) {
   $this->tabela = $tabela;
   try {
     $this->conexao = new PDO('mysql:host='.self::HOST.';dbname='.self::DBNAME, self::USER, self::PASSWORD, array('charset'=>'utf8'));
 } catch (PDOException $e) {
     echo "Erro ao conectar ao BDD: ".$e->getMessage();
   }
 }

 /**
  * Método para executar as queries
  * @param string $query
  * @param array $params
  * @return PDOStetament
  */
  public function execute( $query, $params = [] ) {
    $stmt = $this->conexao->prepare( $query );
    $stmt->execute( $params );
    return $stmt;
  }

 /**
  * Método da query de inserção
  * @param [tipo] $values
  * @return [tipo]
  */
public function insert( $values = [] ) {
  // Prepara as partes da query
  $fields = implode(',', array_keys( $values ));
  $binds = implode(',', array_pad([], count(array_keys($values)), '?'));
  // Monta a query
  $query = 'INSERT INTO '.$this->tabela.' ('.$fields.') VALUES ('.$binds.')';
  // Executa a query
  $this->execute($query, array_values($values));

  return $this->conexao->lastInsertId();

}

/**
 * Método da query de seleção
 * @param string $where
 * @param string $order
 * @param string $limit
 * @param string $fields
 * @return PDOStatement
 */
public function select( $where = null, $order = null, $limit = null, $fields = '*' ) {

  // Prepara as partes da query
  $where = strlen($where) ? 'WHERE '.$where : '';
  $order = strlen($order) ? 'ORDER BY '.$order : '';
  $limit = strlen($limit) ? 'LIMIT '.$limit : '';
  // Monta a query
  $query = 'SELECT '.$fields.' FROM '.$this->tabela.' '.$where.' '.$order.' '.$limit;

  //Executa a query
  return $this->execute( $query );
}

/**
 * Método da query de edição
 * @param string $id
 * @param array $values
 * @return boolean
 */
public function update( $where, $values ) {
  // Prepara partes da query
  $fields = array_keys( $values );
  // Monta a query
  $query = 'UPDATE '.$this->tabela.' SET '.implode('=?,', $fields).'=? WHERE '.$where;
  // Executa a query
  $this->execute( $query, array_values( $values ) );

  return true;
}

/**
 * Método da query de deleção
 * @param string $where
 * @return boolean
 */
public function delete( $where ) {
  $query = 'DELETE FROM '.$this->tabela.' WHERE '.$where;
  $this->execute( $query );

  return true;
}

}
