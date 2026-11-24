<?php
declare(strict_types=1);
error_reporting(E_ALL);

require_once __DIR__ . '/../src/validate.php';

$name = '';
$email = '';
$message = '';
$errors = []; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name    = isset($_POST['name'])    ? trim($_POST['name'])    : '';
    $email   = isset($_POST['email'])   ? trim($_POST['email'])   : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    if (!validate_required($name)) {
        $errors['name'] = 'Name is required.';
    } elseif (!validate_length($name, 2, 60)) {
        $errors['name'] = 'Name is too short or too long (2-60 characters).';
    }

    if (!validate_required($email)) {
        $errors['email'] = 'Email is required.';
    } elseif (!validate_email($email)) {
        $errors['email'] = 'Invalid email address.';
    }

    if (!validate_required($message)) {
        $errors['message'] = 'Message is required.';
    } elseif (!validate_length($message, 10, 1000)) {
        $errors['message'] = 'Message is too short or too long (10-1000 characters).';
    }
    if (empty($errors)) {
        header('Location: success.php', true, 303);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Contact Us</title>
  <style>.error { color: red; }</style>
</head>
<body>
  <h1>Contact Us</h1>

  <?php if (!empty($errors)) { ?>
    <p class="error">Error: please fix the problems below.</p>
  <?php } ?>

  <form method="post" action="index.php">
    <label>Name
      <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
    </label>
    <?php if (isset($errors['name'])) { ?>
      <span class="error"><?php echo htmlspecialchars($errors['name']); ?></span>
    <?php } ?>
    <br>

    <label>Email
      <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
    </label>
    <?php if (isset($errors['email'])) { ?>
      <span class="error"><?php echo htmlspecialchars($errors['email']); ?></span>
    <?php } ?>
    <br>

    <label>Message
      <textarea name="message"><?php echo htmlspecialchars($message); ?></textarea>
    </label>
    <?php if (isset($errors['message'])) { ?>
      <span class="error"><?php echo htmlspecialchars($errors['message']); ?></span>
    <?php } ?>
    <br>

    <button type="submit">Send</button>
  </form>
</body>
</html>
