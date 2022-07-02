<?php

class Person
{
    const AVG_LIFE_SPAN = 80;

    private $firstName;
    private $lastName;
    private $yearBorn;

    function __construct($tempFirst = "", $temLast = "", $tempYear = 2000)
    {
        echo "Person Constructor" . PHP_EOL;

        $this->firstName = $tempFirst;
        $this->lastName = $temLast;
        $this->yearBorn = $tempYear;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $tempName): void
    {
        $this->firstName = $tempName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    protected function getFullName()
    {
        echo "Person->getFullName()" . PHP_EOL;

        return $this->firstName . " " . $this->lastName . PHP_EOL;
    }
}

class Author extends Person
{
    private $penName = "Mark Twain";

    public function getPenName()
    {
        return $this->penName . PHP_EOL;
    }

    public function getCompleteName()
    {
        return $this->getFullName() . " a.k.a " . $this->penName . PHP_EOL;
    }
}

$newAuthor = new Author("Samuel Langhorne", "Clemens", 1899);

echo $newAuthor->getCompleteName();


