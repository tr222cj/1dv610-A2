<?php
declare (strict_types = 1);

namespace model;

interface UserDAL {

    public static function select(string $username);

    public static function save(UserModel $user);
}
