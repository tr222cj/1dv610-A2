<?php
declare (strict_types = 1);

namespace model;

use core\Tool;

final class UserModel {

    private $id;
    private $username;
    private $password;
    private $token;
    private $sessionId;
    private $ip;
    private $browser;

    public function getId() : int {
        return $this->id ?? 0;
    }

    public function getUsername() : string {
        return $this->username ?? '';
    }

    public function setUsername(string $username) {
        $this->username = $username;
    }

    public function getPassword() : string {
        return $this->password ?? '';
    }

    public function setAndHashPassword(string $password) {
        $this->password = Tool::hashPassword($password);
    }

    public function getToken() : string {
        return $this->token ?? '';
    }

    public function setToken(string $token) {
        $this->token = $token;
    }

    public function getSessionId() : string {
        return $this->sessionId ?? '';
    }

    public function setSessionId(string $sessionId) {
        $this->sessionId = $sessionId;
    }

    public function getIp() : string {
        return $this->ip ?? '';
    }

    public function setIp(string $ip) {
        $this->ip = $ip;
    }

    public function getBrowser() : string {
        return $this->browser ?? '';
    }

    public function setBrowser(string $browser) {
        $this->browser = $browser;
    }
}
