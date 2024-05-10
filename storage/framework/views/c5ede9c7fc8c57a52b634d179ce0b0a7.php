<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Bank</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Loan Form</h1>
    <h2>Existing Loans:</h2>
    <table>
        <thead>
        <tr>
            <th>Unique Code</th>
            <th>Borrower Name</th>
            <th>Initial Amount</th>
            <th>Amount left</th>
            <th>Term (months)</th>
            <th>Monthly Payment</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loan->formatted_id); ?></td> <!-- Display unique code here -->
                <td><?php echo e($loan->borrower_name); ?></td>
                <td>$<?php echo e($loan->initial_amount); ?></td>
                <td>$<?php echo e($loan->amount_left); ?></td>
                <td><?php echo e($loan->term_months); ?></td>
                <td>$<?php echo e($loan->monthly_payment); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <h2>Create a New Loan</h2>
    <form action="<?php echo e(route('loans.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div>
            <label for="borrower_name">Borrower Name:</label>
            <input type="text" id="borrower_name" name="borrower_name" required>
        </div>
        <div>
            <label for="initial_amount">Amount (BGN):</label>
            <input type="number" id="initial_amount" name="initial_amount" min="1" max="80000" step="0.01" required>
        </div>
        <div>
            <label for="term_months">Term (months):</label>
            <input type="number" id="term" name="term_months" min="3" max="120" required>
        </div>
        <button type="submit">Submit</button>
    </form>
    <h2>Make a Payment</h2>
    <form action="<?php echo e(route('payments.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div>
            <label for="loan_id">Select Loan:</label>
            <select id="loan_id" name="loan_id" required>
                <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($loan->id); ?>"><?php echo e($loan->formatted_id); ?> - <?php echo e($loan->borrower_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div>
            <label for="amount">Amount (BGN):</label>
            <input type="number" id="amount" name="amount" min="1" step="0.01" required>
        </div>
        <button type="submit">Make Payment</button>
    </form>
</div>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/index.blade.php ENDPATH**/ ?>