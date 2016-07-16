<?php
namespace App\Users\Models;

/**
 * Model da tabela 'Moviments'
 *
 * @package App\Moviments\Models
 * @author Otávio Augusto Borges Pinto <otavio@agenciasys.com.br>
 * @copyright Softers Sistemas de Gestão © 2016
 */
class Moviments extends \App\Models\BaseModel
{
    /**
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $iMovimentId;

    /**
     * @Column(type="integer", length=10, nullable=false)
     */
    public $iUserId;

    /**
     * @Column(type="date", nullable=false)
     */
    public $dtMoviment;

    /**
     * @Column(type="string", length=200, nullable=false)
     */
    public $sDescription;

    /**
     * @Column(type="string", length=50, nullable=false)
     */
    public $sCategory;

    /**
     * @Column(type="decimal", nullable=false)
     */
    public $nValue;

}
