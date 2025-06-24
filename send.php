<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars(trim($_POST["name"]));
  $email = htmlspecialchars(trim($_POST["email"]));
  $message = nl2br(htmlspecialchars(trim($_POST["message"]))); 

  $to = "vera.kralova@applifting.cz";
  $subject = "📬 Nová zpráva z kontaktního formuláře";
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
  $headers .= "From: $name <$email>\r\n";
  $headers .= "Reply-To: $email\r\n";

  $body = "
  <div style='font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, sans-serif; background: #fdf4ff; color: #333; padding: 2rem; border-radius: 1rem; max-width: 600px; margin: 0 auto; box-shadow: 0 10px 25px rgba(0,0,0,0.07);'>
    <h2 style='color: #8b5cf6; font-size: 1.8rem; margin-bottom: 1rem;'>💌 Nová zpráva z webu</h2>
    <p style='margin-bottom: 1.5rem;'>Někdo právě vyplnil kontaktní formulář na tvém webu.</p>

    <div style='margin-bottom: 1rem;'>
      <strong>👤 Jméno:</strong><br>
      $name
    </div>

    <div style='margin-bottom: 1rem;'>
      <strong>📧 Email:</strong><br>
      <a href='mailto:$email' style='color:#8b5cf6;'>$email</a>
    </div>

    <div style='margin-bottom: 1rem;'>
      <strong>📝 Zpráva:</strong><br>
      <div style='margin-top: 0.5rem; padding: 1rem; background: #fff; border-left: 4px solid #ec4899; border-radius: 0.5rem;'>
        $message
      </div>
    </div>

    <p style='margin-top: 2rem; font-size: 0.9rem; color: #999;'>Tato zpráva byla odeslána přes formulář na webu Věra Králová.</p>
  </div>
  ";

  $successMessage = "
  <!DOCTYPE html>
  <html lang='cs'>
  <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Děkuji za zprávu</title>
    <style>
      body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #fdf4ff;
        margin: 0;
        padding: 2rem;
        color: #333;
      }
      .box {
        max-width: 600px;
        margin: 4rem auto;
        background: #fef9fb;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        text-align: center;
      }
      .btn {
        display: inline-block;
        margin-top: 2rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(to right, #8b5cf6, #ec4899);
        color: white;
        border-radius: 9999px;
        text-decoration: none;
        font-weight: bold;
      }
    </style>
  </head>
  <body>
    <div class='box'>
      <h2 style='font-size: 2rem; color: #9d174d;'>📩 Děkuji za vaši zprávu!</h2>
      <p style='font-size: 1.1rem; margin-top: 1rem;'>Jsem ráda, že jste se mi ozvali.</p>
      <p style='font-size: 1rem; margin-top: 0.5rem;'>Jakmile to bude možné, osobně se vám ozvu zpět.</p>
      <p style='margin-top: 2rem; font-size: 1rem; color: #777;'>S pozdravem,<br><strong>Věra Králová</strong></p>
      <a href='index.html' class='btn'>Zpět na hlavní stránku</a>
    </div>
  </body>
  </html>
  ";

  $errorMessage = "
  <!DOCTYPE html>
  <html lang='cs'>
  <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Chyba odeslání</title>
    <style>
      body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #fff0f3;
        margin: 0;
        padding: 2rem;
        color: #333;
      }
      .box {
        max-width: 600px;
        margin: 4rem auto;
        background: #fff;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        text-align: center;
      }
      .btn {
        display: inline-block;
        margin-top: 2rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(to right, #8b5cf6, #ec4899);
        color: white;
        border-radius: 9999px;
        text-decoration: none;
        font-weight: bold;
      }
    </style>
  </head>
  <body>
    <div class='box'>
      <h2 style='font-size: 2rem; color: #b91c1c;'>❌ Něco se pokazilo</h2>
      <p style='font-size: 1rem; margin-top: 1rem;'>Omlouvám se, zprávu se nepodařilo odeslat.</p>
      <p style='font-size: 1rem; color: #777; margin-top: 0.5rem;'>Zkuste to prosím později, nebo mi napište přímo na <a href='mailto:vera@email.cz' style='color:#8b5cf6;'>vera@email.cz</a>.</p>
      <a href='index.html' class='btn'>Zpět na hlavní stránku</a>
    </div>
  </body>
  </html>
  ";

  // Poslat mail a zobrazit výsledek
  if (mail($to, $subject, $body, $headers)) {
    echo $successMessage;
  } else {
    echo $errorMessage;
  }

} else {
  header("Location: index.html");
  exit();
}
?>
