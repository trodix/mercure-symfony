<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
*/
class Book
{

    public function __construct(int $id, string $name, string $status) {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
    }

    /**
     * @ORM\Id
     * @ORM\Column
     */
    public $id;

    /**
     * @ORM\Column
     */
    public $name;

    /**
     * @ORM\Column
     */
    public $status;
}