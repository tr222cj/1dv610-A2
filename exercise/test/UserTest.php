<?php

use core\DatabaseFactory;
use model\UserDALMySql;

class UserTest {

    private $usernameNotExists = 'Tomas';
    private $usernameExists = 'Admin';

    public function __construct() {
        $this->init();

        $this->shouldReturnNewUserWithZeroId($this->usernameNotExists);
        $this->shouldReturnNewUserWithId($this->usernameExists);

        $this->shouldCreateNewUser();
        $this->shouldUpdateUser();

        echo "All is fine :)";
    }

    public function init() {
        $database = DatabaseFactory::getFactory()->getConnection();

        // Make sure this user does _not_ exist
        $sql = 'DELETE FROM AppUser WHERE username = :username';

        $query = $database->prepare($sql);

        $query->execute([
            ':username' => $this->usernameNotExists,
        ]);

        // Make sure this user does exist
        // TODO: Insert SQL
    }

    public function shouldReturnNewUserWithZeroId(string $username) {
        $sut = UserDALMySql::select($username);

        assert($sut->getId() === 0);
    }

    public function shouldReturnNewUserWithId(string $username) {
        $sut = UserDALMySql::select($username);

        assert($sut->getId() !== 0);
    }

    public function shouldCreateNewUser() {
        $sut = UserDALMySql::select($this->usernameNotExists);

        assert($sut->getId() === 0);

        $sut->setUsername($this->usernameNotExists);

        UserDALMySql::save($sut);

        $sut = UserDALMySql::select($this->usernameNotExists);

        assert($sut->getId() !== 0);
    }

    public function shouldUpdateUser() {
        $oldUser = UserDALMySql::select($this->usernameNotExists);
        $oldUser->setAndHashPassword('original');
        UserDALMySql::save($oldUser);

        $newUser = UserDALMySql::select($this->usernameNotExists);
        $newUser->setAndHashPassword('updated');
        UserDALMySql::save($newUser);

        assert($oldUser->getId() === $newUser->getId());
    }
}
