<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge 1</title>
    <style>
        table {
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
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
    <div style="display: flex; justify-content: center; align-items: center; flex-flow: column; margin-bottom: 1em;">
        <h1>Challenge 1</h1>
        <?php
        $transaction = new Transaction;
        echo "Check Balance => " . $transaction->getBalance();
        echo "<br>";
        echo "Deposit 100" . $transaction->deposit(100);
        echo "<br>";
        echo "Check Balance => " . $transaction->getBalance();
        echo "<br>";
        echo "Withdraw 25" . $transaction->withdraw(25);
        echo "<br>";
        echo "Check Balance => " . $transaction->getBalance();
        echo "<br>";
        echo "Deposit 10" . $transaction->deposit(10);
        echo "<br>";
        echo "Check Balance => " . $transaction->getBalance();
        echo "<br>";
        echo "Withdraw 100 => " . $transaction->withdraw(100);
        echo "<br>";
        // print_r($transaction->getHistory());
        $history = $transaction->getHistory();
        ?>
    </div>

    <div style="display: flex; justify-content: center; align-items: center;flex-flow: column;">
        <h1>Challenge 2</h1>
        <table style="table-layout: auto; width: 600px; border-collapse: collapse; margin-bottom: 1em;">
            <tr>
                <th>Time</th>
                <th>Type</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Balance</th>
            </tr>
            <?php
                foreach ($history as $key => $value) {
                    echo "<tr>";
                    echo "<td>".$value['time']."</td>";
                    echo "<td>".$value['type']."</td>";
                    echo "<td>".$value['debit']."</td>";
                    echo "<td>".$value['credit']."</td>";
                    echo "<td>".$value['balance']."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <a href="/talentvis/public/transaction/challenge3">
            <button
                style="width: 200px; height: 40px; border-radius: 16px; border: none; background-color: #475462; color: white; cursor: pointer;"
            >See the Challenge 3</button>
        </a>
    </div>

</body>

</html>