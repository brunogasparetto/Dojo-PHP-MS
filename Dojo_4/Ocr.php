<?php

/**
 * Resolução do exercício do 4 DOJO PHP-MS
 * Um OCR simples
 *
 * @author Bruno Gasparetto
 */
class Ocr {

    const SYMBOL_LENGTH = 3;
    const SYMBOL_HEIGHT = 3;

    const LINE_TOP    = 0;
    const LINE_MIDDLE = 1;
    const LINE_BOTTOM = 2;

    /**
     * Arquivo a ser interpretado
     * @var SplFileObject
     */
    private $file;

    /**
     * As linhas que compõem os símbolos
     * @var array
     */
    private $lines = array();

    /**
     * Nosso mapeamento entre números e símbolos
     * @var array
     */
    private $symbols = array(
        0 => array(
            ' _ ',
            '| |',
            '|_|'),
        1 => array(
            '   ',
            '  |',
            '  |'),
        2 => array(
            ' _ ',
            ' _|',
            '|_ '),
        3 => array(
            ' _ ',
            ' _|',
            ' _|'),
        4 => array(
            '   ',
            '|_|',
            '  |'),
        5 => array(
            ' _ ',
            '|_ ',
            ' _|'),
        6 => array(
            ' _ ',
            '|_ ',
            '|_|'),
        7 => array(
            ' _ ',
            '  |',
            '  |'),
        8 => array(
            ' _ ',
            '|_|',
            '|_|'),
        9 => array(
            ' _ ',
            '|_|',
            '  |')
    );

    /**
     * @param string $filepath
     */
    public function __construct($filepath) {
        $this->openFile($filepath);
    }

    /**
     * Retorna os números interpretados do arquivo de entrada.
     *
     * @return array
     */
    public function getNumbers() {
        $result = array();

        while ( $number = $this->readNumber() ) {
            $result[] = $number;
        }

        return $result;
    }

    /**
     * Cria a interface para leitura do arquivo.
     *
     * @param string $filepath
     */
    private function openFile($filepath) {
        try {
            $this->file = new SplFileObject($filepath);
            $this->file->setFlags(SplFileObject::DROP_NEW_LINE);
        } catch ( Exception $e ) {
            exit($e->getMessage());
        }
    }

    /**
     * Efetua a leitura do número da linha atual do arquivo.
     *
     * @return string String para evitar problemas com números iniciados com 0
     */
    private function readNumber() {

        if ( $this->eof() ) {
            return '';
        }

        $number = '';

        while ( $symbol = $this->readSymbol() ) {
            $number .= $this->convertSymbol($symbol);
        }

        return $number;
    }

    /**
     * Lê um símbolo completo o retornando como array ou NULL em caso de falha.
     *
     * @return mixed NULL or Array
     */
    private function readSymbol() {

        if ( empty($this->lines[self::LINE_TOP]) ) {
            return NULL;
        }

        $symbol = array(
            self::LINE_TOP    => implode('', array_splice($this->lines[self::LINE_TOP],    0, self::SYMBOL_LENGTH)),
            self::LINE_MIDDLE => implode('', array_splice($this->lines[self::LINE_MIDDLE], 0, self::SYMBOL_LENGTH)),
            self::LINE_BOTTOM => implode('', array_splice($this->lines[self::LINE_BOTTOM], 0, self::SYMBOL_LENGTH))
        );

        return $symbol;
    }

    /**
     * Converte o símbolo no seu número correspondente
     *
     * @param array $symbolreaded
     * @return string
     */
    private function convertSymbol($symbolreaded) {

        foreach ( $this->symbols as $number => $symbol ) {
            if ( $symbol === $symbolreaded ) {
                return $number;
            }
        }
        return '';
    }

    /**
     * Lê a próxima linha do arquivo e indica status da leitura
     *
     * @return bool
     */
    private function readLine() {
        try {
            // Preferi trabalhar com array para facilitar usando array_splice
            $this->lines[self::LINE_TOP]    = str_split($this->file->fgets(), 1);
            $this->lines[self::LINE_MIDDLE] = str_split($this->file->fgets(), 1);
            $this->lines[self::LINE_BOTTOM] = str_split($this->file->fgets(), 1);
        } catch ( Exception $e ) {
            return false;
        }

        return true;
    }

    /**
     * Indica fim do arquivo (End of File)
     *
     * @return bool
     */
    private function eof() {
        return (!$this->readLine() AND empty($this->lines[self::LINE_TOP]));
    }
}
