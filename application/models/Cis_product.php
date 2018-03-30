<?php
/**
 * @Entity @Table(name="cis_product")
 **/
class Cis_product extends CI_Model
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="string") **/
    protected $productName;
    /** @Column(type="int") **/
    protected $productCode;
}
