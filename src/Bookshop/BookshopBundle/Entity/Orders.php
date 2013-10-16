<?php

namespace Bookshop\BookshopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="Bookshop\BookshopBundle\Entity\OrdersRepository")
 */
class Orders {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="User", inversedBy="orders")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $userId;

    /**
     * @var integer
     * 
     * @ORM\OneToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="billingId", referencedColumnName="id")
     */
    private $billingId;

    /**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="shippingId", referencedColumnName="id")
     * 
     */
    private $shippingId;

    /**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="Cart")
     * @ORM\JoinColumn(name="cartId", referencedColumnName="id")
     */
    private $cartItId;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="decimal")
     */
    private $Total;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="stateId", type="integer")
     */
    private $stateId;

    /**
     * @var integer
     *
     * @ORM\Column(name="shipmethodId", type="integer")
     */
    private $shipmethod;

    /**
     * @var integer
     *
     * @ORM\Column(name="paymentId", type="integer")
     */
    private $paymentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted", type="integer")
     */
    private $deleted;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Orders
     */
    public function setUserId($userId) {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * Set billingId
     *
     * @param integer $billingId
     * @return Orders
     */
    public function setBillingId($billingId) {
        $this->billingId = $billingId;

        return $this;
    }

    /**
     * Get billingId
     *
     * @return integer 
     */
    public function getBillingId() {
        return $this->billingId;
    }

    /**
     * Set ship
     *
     * @param integer $ship
     * @return Orders
     */
    public function setShip($ship) {
        $this->ship = $ship;

        return $this;
    }

    /**
     * Get ship
     *
     * @return integer 
     */
    public function getShip() {
        return $this->ship;
    }

    /**
     * Set cartItId
     *
     * @param integer $cartItId
     * @return Orders
     */
    public function setCartItId($cartItId) {
        $this->cartItId = $cartItId;

        return $this;
    }

    /**
     * Get cartItId
     *
     * @return integer 
     */
    public function getCartItId() {
        return $this->cartItId;
    }

    /**
     * Set :Total
     *
     * @param float $:Total
     * @return Orders
     */
    public function setTotal($Total) {
        $this->Total = $Total;

        return $this;
    }

    /**
     * Get :Total
     *
     * @return float 
     */
    public function getTotal() {
        return $this->Total;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Orders
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set stateId
     *
     * @param integer $stateId
     * @return Orders
     */
    public function setStateId($stateId) {
        $this->stateId = $stateId;

        return $this;
    }

    /**
     * Get stateId
     *
     * @return integer 
     */
    public function getStateId() {
        return $this->stateId;
    }

    /**
     * Set shippingmethodId
     *
     * @param integer $shippingmethodId
     * @return Orders
     */
    public function setShippingmethodId($shippingmethodId) {
        $this->shippingmethodId = $shippingmethodId;

        return $this;
    }

    /**
     * Get shippingmethodId
     *
     * @return integer 
     */
    public function getShippingmethodId() {
        return $this->shippingmethodId;
    }

    /**
     * Set paymentId
     *
     * @param integer $paymentId
     * @return Orders
     */
    public function setPaymentId($paymentId) {
        $this->paymentId = $paymentId;

        return $this;
    }

    /**
     * Get paymentId
     *
     * @return integer 
     */
    public function getPaymentId() {
        return $this->paymentId;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     * @return Orders
     */
    public function setDeleted($deleted) {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return integer 
     */
    public function getDeleted() {
        return $this->deleted;
    }

}
