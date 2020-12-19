<?php
namespace App\Application\Command;

use Lib\Validation\Attribute\Double;
use Lib\Validation\Attribute\Required;
use Lib\Validation\Attribute\Varchar;
use Lib\CQRS\BaseCommand;

class AddProductCommand extends BaseCommand
{
    #[Required, Varchar(100)]
    public $name;

    #[Required, Double]
    public $priceAmount;

    #[Required, Varchar(3)]
    public $priceCurrency;
}