<?php

$_SESSION['logTransaction'] = array();

class Transaction extends Login
{

    private $balance;
    private $history;
    private $datetime;

    public function __construct()
    {
        $this->balance = 0;
        $this->history = array();
        $this->datetime = date("y-m-d H:i");
    }

    public function index()
    {
        $data = array();
        $data['balance'] = $this->balance;
        $this->view('transaction/index', $data);
    }

    public function challenge3()
    {
        $this->view('transaction/challenge3');
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function deposit(int $value)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['loggedIn']) {
            $_SESSION['user']['balance'] += $value;
            $this->setHistory("Deposit", $value, $_SESSION['user']['balance']);
        } else {
            $this->balance += $value;
            $this->setHistory("Deposit", $value, $this->balance);
        }

    }

    public function withdraw(int $value)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['loggedIn']) {
            if ($value > $_SESSION['user']['balance']) {
                return "Your balance is insufficient";
            } else {
                $_SESSION['user']['balance'] -= $value;
                $this->setHistory("Withdraw", $value, $_SESSION['user']['balance']);
            }
        }

        if ($value > $this->balance) {
            return "Your balance is insufficient";
        } else {
            $this->balance -= $value;
            $this->setHistory("Withdraw", $value, $this->balance);
        }
    }

    public function setHistory($type, $value, $balance)
    {
        if (isset($_SESSION['user'])) {
            $_SESSION['user']['history'][] = array(
                "time" => date("y-m-d H:i", strtotime("{$this->datetime} + 10 minutes")),
                "type" => $type,
                "debit" => strtolower($type) == 'deposit' ? $value : "",
                "credit" => strtolower($type) == 'withdraw' ? $value : "",
                "balance" => $balance
            );
            $_SESSION['logTransaction'][$_SESSION['user']['name']][] = array(
                "time" => date("y-m-d H:i", strtotime("{$this->datetime} + 10 minutes")),
                "type" => $type,
                "debit" => strtolower($type) == 'deposit' ? $value : "",
                "credit" => strtolower($type) == 'withdraw' ? $value : "",
                "balance" => $balance
            );
        }
        $this->history[] = array(
            "time" => date("y-m-d H:i", strtotime("{$this->datetime} + 10 minutes")),
            "type" => $type,
            "debit" => strtolower($type) == 'deposit' ? $value : "",
            "credit" => strtolower($type) == 'withdraw' ? $value : "",
            "balance" => $balance
        );
    }

    public function transfer($form, $to, $value){
        $_SESSION['user']['balance'] = $_SESSION['user']['balance'] - $value;
        $_SESSION['logTransaction'][$form][] = array(
            "time" => date("y-m-d H:i", strtotime("{$this->datetime} + 10 minutes")),
            "type" => 'Transfer',
            "debit" => "",
            "credit" => $value,
            "balance" => end($_SESSION['logTransaction'][$form])['balance'] - $value
        );
        $_SESSION['logTransaction'][$to][] = array(
            "time" => date("y-m-d H:i", strtotime("{$this->datetime} + 10 minutes")),
            "type" => 'Transfer',
            "debit" => $value,
            "credit" => "",
            "balance" => end($_SESSION['logTransaction'][$to])['balance'] + $value
        );
    }

    public function getHistory()
    {
        return $this->history;
    }
}

class Login extends Controller
{
    private $user;
    private $transaction;

    public function __construct()
    {
        $this->user = array();
        $this->transaction = new Transaction;
    }

    public function login($user)
    {
        if ($user == 'Feon' || $user == 'Vira') {
            if(!array_key_exists($user, $_SESSION['logTransaction'])){
                $_SESSION['user'] = array(
                    "name" => $user,
                    "balance" => 0,
                    "loggedIn" => true
                );
            } else {
                $_SESSION['user']['name'] = $user;
                $_SESSION['user']['balance'] = end($_SESSION['logTransaction'][$user])['balance'];
                $_SESSION['user']['loggedIn'] = true;
            }
        } else {
            return "Login failed";
        }
    }

    public function isLoggedIn()
    {
        if ($_SESSION['user']['loggedIn']) {
            return true;
        }
    }

    public function logout()
    {
        $_SESSION['user']['loggedIn'] = false;
    }
}
