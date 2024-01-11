<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Page</title>
    <link rel="stylesheet" href="css/styleLogin.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
    />
 
  </head>
  <body>
    <main>
      <h2>Zoom-Marketplace</h2>
      <section>
        <h1>
          <span>V-Learnㅤ⠀ㅤㅤ⠀ㅤ</span>
        </h1>
        <form id="form" action="login/sessionStart.php" method="POST">
          <div class="input-container">
            <i class="fas fa-envelope"></i>
            <input type="email" id="email" name="correo" placeholder="Email" />
          </div>
          <div class="input-container">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Password" />
          </div>
          <button type="submit" id="submit">
            <i class="fas fa-sign-in-alt"></i> Iniciar
          </button>
        </form>
      </section>
      <img src="https://i.blogs.es/2ab7c1/conferenceroom2/1366_2000.jpg" alt="coding image" />
    </main>
  </body>
</html>
