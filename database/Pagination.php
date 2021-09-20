<?php

include_once 'Database.php';

/**
 * Método responsável pela paginação
 */
class Pagination {

  /**
   * Número máximo de registros por página
   * @var integer
   */
   private $limit;

   /**
    * Quantidade total de resultados do banco
    * @var integer
    */
    private $results;

    /**
     * Quantidade de páginas
     * @var integer
     */
     private $pages;

     /**
      * Página atual
      * @var integer
      */
      public $currentPage;

  /**
   * Construtor da classe
   * @param integer $results
   * @param integer $currentPage
   * @param integer $limit
   */
  function __construct($results, $currentPage = 1, $limit = 50)
  {
    $this->results = $results;
    $this->limit = $limit;
    $this->currentPage = ( is_numeric($currentPage) && $currentPage > 0 ) ? $currentPage : 1;
    $this->calculate();
  }

  /**
   * Método responsável por calcular o total de páginas
   */
   private function calculate( ) {
     $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;
     $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
   }

   /**
    * Método responsável por retornar a cláusula limit do SQL
    * @return string
    */
    public function getLimit() {
      $offset = ($this->limit * ($this->currentPage - 1));
      return $offset.','.$this->limit;
    }

    /**
     * Método responsável por retornar as páginas disponíveis
     * @return array
     */
     public function getPages() {
       // Não retorna páginas
       if ($this->pages == 1) return[];

       // Páginas
       $paginas = [];
       for ($i=1; $i <= $this->pages; $i++) {
         $paginas[] = [
           'pagina' => $i,
           'atual' => $i == $this->currentPage
         ];
       }
       return $paginas;
     }

}