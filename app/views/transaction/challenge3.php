<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge 3</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #F6F8F9;
        }
    </style>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; color: #475462;">
    <div style="display: flex; justify-content: center; align-items: center;flex-flow: column;">
        <h1>Challenge 3</h1>
        <?php
        $user = new Login();
        echo "Login Feon" . $user->login('Feon');
        echo "<br>";
        $feon = new Transaction();
        $feon->deposit(100);
        echo "Deposit 100 => Balance Feon " . $_SESSION['user']['balance'];
        echo "<br>";
        echo "Logout Feon" . $feon->logout();
        echo "<br>";

        $user->login('Vira');
        echo "Login Vira";
        echo "<br>";
        $vira = new Transaction();
        $vira->deposit(200);
        echo "Deposit 200 => Balance Vira " . $_SESSION['user']['balance'];
        echo "<br>";
        $vira->withdraw(50);
        echo "Withdraw 50 => Balance Vira " . $_SESSION['user']['balance'];
        echo "<br>";
        $vira->logout();
        echo "Logout Vira";
        echo "<br>";

        $user->login('Feon');
        echo "Login Feon";
        echo "<br>";
        $feon->transfer('Feon', 'Vira', 75);
        echo "Transfer Vira 75 => Balance Feon " . $_SESSION['user']['balance'] . ", Balance Vira " . end($_SESSION['logTransaction']['Vira'])['balance'];
        echo "<br>";
        echo "Withdraw 50 => " . $feon->withdraw(50);
        echo "<br>";
        $feon->logout();
        echo "Logout Feon";
        echo "<br>";

        $user->login('Vira');
        echo "Login Vira";
        echo "<br>";
        $vira->withdraw(200);
        echo "Withdraw 200 => Balance Vira " . $_SESSION['user']['balance'];
        echo "<br>";
        $vira->deposit(25);
        echo "Deposit 25 => Balance Vira " . $_SESSION['user']['balance'];
        echo "<br>";
        echo "Withdraw 75 => " . $vira->withdraw(75);
        echo "<br>";

        ?>
    </div>
    <div style="display: flex; justify-content: center; align-items: center;flex-flow: column;">
        <?php
        $feonTable = $_SESSION['logTransaction']['Feon'];

        echo "<h2>Feon</h2>";
        echo "<table style='table-layout: auto; width: 600px; border-collapse: collapse; margin-bottom: 1em;'>";
        echo "<tr>";
        echo "<th>Time</th>";
        echo "<th>Type</th>";
        echo "<th>Debit</th>";
        echo "<th>Credit</th>";
        echo "<th>Balance</th>";
        echo "</tr>";
        foreach ($feonTable as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value['time'] . "</td>";
            echo "<td>" . $value['type'] . "</td>";
            echo "<td>" . $value['debit'] . "</td>";
            echo "<td>" . $value['credit'] . "</td>";
            echo "<td>" . $value['balance'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
        <?php
        $viraTable = $_SESSION['logTransaction']['Vira'];

        echo "<h2>Vira</h2>";
        echo "<table style='table-layout: auto; width: 600px; border-collapse: collapse; margin-bottom: 1em;'>";
        echo "<tr>";
        echo "<th>Time</th>";
        echo "<th>Type</th>";
        echo "<th>Debit</th>";
        echo "<th>Credit</th>";
        echo "<th>Balance</th>";
        echo "</tr>";
        foreach ($viraTable as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value['time'] . "</td>";
            echo "<td>" . $value['type'] . "</td>";
            echo "<td>" . $value['debit'] . "</td>";
            echo "<td>" . $value['credit'] . "</td>";
            echo "<td>" . $value['balance'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
        <a href="/talentvis/public/transaction">
            <button
                style="width: 200px; height: 40px; border-radius: 16px; border: none; background-color: #475462; color: white; cursor: pointer;">See the Challenge 1 & 2</button>
    </div>
</body>

</html>