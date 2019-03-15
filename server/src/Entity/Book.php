<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
*/
class Book
{

    public function __construct(string $name, string $status) {
        $this->name = $name;
        $this->status = $status;
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=180)
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    public $status;
}