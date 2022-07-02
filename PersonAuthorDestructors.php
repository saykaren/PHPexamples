<!-- destructors -->

<?php

class Person
{
    const AVG_LIFE_SPAN = 80;

    private $firstName;
    private  $lastName;
    private $yearBorn;

    protected static $parentCenturyPopular = "18th";

    function __construct($tempFirst = "", $temLast = "", $tempYear = 2000)
    {
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
        echo "Person->getFullName()".PHP_EOL;

        return $this->firstName." ".$this->lastName.PHP_EOL;
    }
}

class Author extends Person
{
    public static $centuryPopular = "19th";
    private $penName = "Mark Twain";

    function __construct($tempFirst = "", $temLast = "", $tempYear = 2000, $tempPenName="")
    {
        parent::__construct($tempFirst, $temLast, $tempYear, $tempPenName);

        $this->penName = $tempPenName;
    }

    public function getPenName()
    {
        return $this->penName.PHP_EOL;
    }

    public function getCompleteName()
    {
        return $this->getFullName()." a.k.a ".$this->penName.PHP_EOL;
    }

    public static function getCenturyAuthorWasPopular()
    {
//        return self::$centuryPopular;
        return parent::$parentCenturyPopular;
    }

    function __destruct()
    {
        echo "Never put off till tomorrow what may be done day after tomorrow just as well - " .$this->penName;
    }
}

$newAuthor = new Author("Samuel Langhorne", "Clemens", 2013, "Mark Twain");

echo $newAuthor->getCompleteName();
echo "The end is here".PHP_EOL;
?>