<?php
namespace App\Users\Controllers;

use App\Controllers\RESTController;
use App\Users\Models\Moviments;
use App\Users\Models\Users;
use DateTime;
use App\Traits\DateTimeConversion;

/**
 * Gerencia as requisições para o módulo admin.
 *
 * @package App\Moviments\Controllers
 * @author Otávio Augusto Borges Pinto <otavio@agenciasys.com.br>
 * @copyright Softers Sistemas de Gestão © 2016
 */
class MovimentsController extends RESTController
{
    use DateTimeConversion;

    /**
     * Retorna uma lista de Usuários.
     *
     * @access public
     * @return Array Lista de Usuários.
     */
    public function getMoviments($iUserId)
    {
        try {
            $moviments = (new Moviments())->find(
                [
                    'conditions' => "iUserId = $iUserId " . $this->getConditions(),
                    'columns' => $this->partialFields,
                    'limit' => $this->limit
                ]
            );

            return $moviments;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Retorna uma lista de Usuários.
     *
     * @access public
     * @return Array Lista de Usuários.
     */
    public function getMovimentsBetween($iUserId, $dtMovimentStart, $dtMovimentEnd)
    {
        try {

            if ($dtMovimentStart > $dtMovimentEnd)
                throw new \Exception("End date must be greater than Start date");

            $dtMovimentStart = $this->formatDateString($dtMovimentStart, "Ymd", "Y-m-d");
            $dtMovimentEnd = $this->formatDateString($dtMovimentEnd, "Ymd", "Y-m-d");
            $conditions = $this->getConditions();

            $moviments = (new Moviments())->find(
                [
                    'conditions' => ("iUserId = $iUserId AND " 
                                        . "dtMoviment BETWEEN '$dtMovimentStart' AND '$dtMovimentEnd' "
                                        . ($conditions != "" ? "AND $conditions" : "")),
                    'columns' => $this->partialFields,
                    'limit' => $this->limit
                ]
            );

            return $moviments;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Retorna um Usuário.
     *
     * @access public
     * @return Array Usuário.
     */
    public function getMoviment($iUserId, $iMovimentId)
    {
        try {
            $moviments = (new Moviments())->findFirst(
                [
                    'conditions' => "iMovimentId = '$iMovimentId'",
                    'columns' => $this->partialFields,
                ]
            );

            return $moviments;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Adiciona um Usuário.
     *
     * @access public
     * @return Array Usuário.
     */
    public function addMoviment($iUserId)
    {
        try {

            $user = (new Users())->findFirst($iUserId);

            if (!$user)
                throw new \Exception("User $iUserId does not exist");

            $moviment = new Moviments();

            $moviment->iUserId = $user->iUserId;
            $moviment->dtMoviment = $this->di->get('request')->getPost('dtMoviment');
            $moviment->sDescription = $this->di->get('request')->getPost('sDescription');
            $moviment->sCategory = $this->di->get('request')->getPost('sCategory');
            $moviment->nValue = $this->di->get('request')->getPost('nValue');

            $moviment->saveDB();

            return $moviment;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Editar o campo de um Usuário.
     *
     * @access public
     * @return Array.
     */
    public function editMoviment($iUserId, $iMovimentId)
    {
        try {
            $put = $this->di->get('request')->getPut();

            $moviment = (new Moviments())->findFirst("iUserId = $iUserId AND iMovimentId = $iMovimentId");

            if (false === $moviment) {
                throw new \Exception("This record doesn't exist", 200);
            }

            $moviment->dtMoviment = isset($put['dtMoviment']) ? $put['dtMoviment'] : $moviment->dtMoviment;
            $moviment->sDescription = isset($put['sDescription']) ? $put['sDescription'] : $moviment->sDescription;
            $moviment->sCategory = isset($put['sCategory']) ? $put['sCategory'] : $moviment->sCategory;
            $moviment->nValue = isset($put['nValue']) ? $put['nValue'] : $moviment->nValue;

            $moviment->saveDB();

            return $moviment;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Remove um Usuário.
     *
     * @access public
     * @return boolean.
     */
    public function deleteMoviment($iUserId, $iMovimentId)
    {
        try {
            $moviment = (new Moviments())->findFirst("iUserId = $iUserId AND iMovimentId = $iMovimentId");

            if (false === $moviment) {
                throw new \Exception("This record doesn't exist", 200);
            }

            return ['success' => $moviment->delete()];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
