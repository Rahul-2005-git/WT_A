<?php
// Electricity Bill Calculator
// Pricing: 50 units @ Rs 3.50, next 100 @ Rs 4.00, next 100 @ Rs 5.20, above 250 @ Rs 6.50

$result = '';
$units = '';
$bill = 0;
$breakdown = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $units = isset($_POST['units']) ? floatval($_POST['units']) : '';
    
    // Validation
    if(empty($units) || $units < 0) {
        $result = '<div class="error">Please enter a valid number of units (0 or positive)</div>';
    } else {
        // Calculate Bill
        $bill = 0;
        
        if($units <= 50) {
            $bill = $units * 3.50;
            $breakdown = $units . " units × Rs 3.50 = Rs " . number_format($units * 3.50, 2);
        }
        elseif($units <= 150) {
            $first50 = 50 * 3.50;
            $remaining = $units - 50;
            $remainingCost = $remaining * 4.00;
            $bill = $first50 + $remainingCost;
            $breakdown = "First 50 units × Rs 3.50 = Rs " . number_format($first50, 2) . "<br>";
            $breakdown .= "Next " . $remaining . " units × Rs 4.00 = Rs " . number_format($remainingCost, 2);
        }
        elseif($units <= 250) {
            $first50 = 50 * 3.50;
            $next100 = 100 * 4.00;
            $remaining = $units - 150;
            $remainingCost = $remaining * 5.20;
            $bill = $first50 + $next100 + $remainingCost;
            $breakdown = "First 50 units × Rs 3.50 = Rs " . number_format($first50, 2) . "<br>";
            $breakdown .= "Next 100 units × Rs 4.00 = Rs " . number_format($next100, 2) . "<br>";
            $breakdown .= "Next " . $remaining . " units × Rs 5.20 = Rs " . number_format($remainingCost, 2);
        }
        else {
            $first50 = 50 * 3.50;
            $next100_1 = 100 * 4.00;
            $next100_2 = 100 * 5.20;
            $remaining = $units - 250;
            $remainingCost = $remaining * 6.50;
            $bill = $first50 + $next100_1 + $next100_2 + $remainingCost;
            $breakdown = "First 50 units × Rs 3.50 = Rs " . number_format($first50, 2) . "<br>";
            $breakdown .= "Next 100 units × Rs 4.00 = Rs " . number_format($next100_1, 2) . "<br>";
            $breakdown .= "Next 100 units × Rs 5.20 = Rs " . number_format($next100_2, 2) . "<br>";
            $breakdown .= "Units above 250 (" . $remaining . ") × Rs 6.50 = Rs " . number_format($remainingCost, 2);
        }
        
        $result = '<div class="success">
                    <h3>Electricity Bill Calculated</h3>
                    <p><strong>Total Units Consumed:</strong> ' . number_format($units, 2) . ' units</p>
                    <div class="breakdown"><strong>Breakdown:</strong><br>' . $breakdown . '</div>
                    <h2 class="bill-amount">Total Bill: Rs ' . number_format($bill, 2) . '</h2>
                  </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Bill Calculator</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>⚡ Electricity Bill Calculator</h1>
            <p>Calculate your monthly electricity bill instantly</p>
        </header>

        <main class="main-content">
            <div class="calculator-section">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="units">Enter Total Units Consumed:</label>
                        <input 
                            type="number" 
                            id="units" 
                            name="units" 
                            value="<?php echo $units; ?>" 
                            placeholder="Enter units (e.g., 120)" 
                            step="0.01"
                            required
                        >
                    </div>
                    <button type="submit" class="btn btn-primary">Calculate Bill</button>
                    <button type="reset" class="btn btn-secondary">Clear</button>
                </form>

                <?php if($result) echo $result; ?>
            </div>

            <!-- Pricing Table -->
            <div class="pricing-section">
                <h2>Pricing Structure</h2>
                <div class="pricing-table">
                    <div class="pricing-row">
                        <div class="pricing-col">
                            <span class="range">Units 1-50</span>
                            <span class="price">Rs 3.50/unit</span>
                        </div>
                    </div>
                    <div class="pricing-row">
                        <div class="pricing-col">
                            <span class="range">Units 51-150</span>
                            <span class="price">Rs 4.00/unit</span>
                        </div>
                    </div>
                    <div class="pricing-row">
                        <div class="pricing-col">
                            <span class="range">Units 151-250</span>
                            <span class="price">Rs 5.20/unit</span>
                        </div>
                    </div>
                    <div class="pricing-row">
                        <div class="pricing-col">
                            <span class="range">Units 250+</span>
                            <span class="price">Rs 6.50/unit</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Examples -->
            <div class="examples-section">
                <h2>Bill Examples</h2>
                <div class="examples">
                    <div class="example-box">
                        <h4>Example 1: 50 Units</h4>
                        <p>50 × Rs 3.50 = <strong>Rs 175.00</strong></p>
                    </div>
                    <div class="example-box">
                        <h4>Example 2: 120 Units</h4>
                        <p>50 × Rs 3.50 = Rs 175.00<br>
                           70 × Rs 4.00 = Rs 280.00<br>
                           <strong>Total = Rs 455.00</strong></p>
                    </div>
                    <div class="example-box">
                        <h4>Example 3: 200 Units</h4>
                        <p>50 × Rs 3.50 = Rs 175.00<br>
                           100 × Rs 4.00 = Rs 400.00<br>
                           50 × Rs 5.20 = Rs 260.00<br>
                           <strong>Total = Rs 835.00</strong></p>
                    </div>
                    <div class="example-box">
                        <h4>Example 4: 300 Units</h4>
                        <p>50 × Rs 3.50 = Rs 175.00<br>
                           100 × Rs 4.00 = Rs 400.00<br>
                           100 × Rs 5.20 = Rs 520.00<br>
                           50 × Rs 6.50 = Rs 325.00<br>
                           <strong>Total = Rs 1,420.00</strong></p>
                    </div>
                </div>
            </div>
        </main>

        <footer class="footer">
            <p>&copy; 2024 Electricity Bill Calculator | Powered by PHP</p>
        </footer>
    </div>
</body>
</html>
