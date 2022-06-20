<?php

namespace MercadoPago\Resources\Payment;

/** PaymentCard class. */
class PaymentCard
{
  /** Id of the card. */
  public $id;

  /** Last four digits of card number. */
  public $last_four_digits;

  /** First six digit of card number. */
  public $first_six_digits;

  /** Card expiration year. */
  public $expiration_year;

  /** Card expiration month. */
  public $expiration_month;

  /** Creation date of card. */
  public $date_created;

  /** Last update of data from the card. */
  public $date_last_updated;

  /** Card's owner data. */
  public $cardholder;
}