<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Acceptance extends \Codeception\Module
{
    public function executeInDatabase($sql)
    {
        $dbh = $this->getModule('Db')->dbh;

        $this->debugSection('Query', $sql);

        $sth = $dbh->prepare($sql);
        return $sth->execute();
    }

    public function recreateObjectTable()
    {
        $this->executeInDatabase("DROP TABLE IF EXISTS objects");
        $this->executeInDatabase("CREATE TABLE IF NOT EXISTS objects (`key` VARCHAR(256) PRIMARY KEY, `data` TEXT NOT NULL)");
    }
}
