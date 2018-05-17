<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta lang="fr">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!-- CSS Perso -->
    <link href="/web/static/css/style.css" rel="stylesheet"/>
    <title><?= $title ?></title>
  </head>
  <body>
    <div class="container-fluid">
      <!-- HEADER -->
      <div class="row">
        <header class="col-xl-12">
            <?php require('header.php'); ?>
        </header>
      </div>
      <!-- NAV ET ARTICLE -->
      <div class="row">
          <nav class="col-xl-2">
              <?php require('nav.php'); ?>
          </nav>
          <article class="col-xl-10">
              <!-- BREADCRUMD à variabiliser-->
              <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Library</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
              </nav> -->
             <?= $article ?>
          </article>
      </div>
      <div class="row">
          <footer class="col-xl-12">
              <?php require('footer.php'); ?>
          </footer>
      </div>
      <!-- debug -->
      <div class="row">
          <div class="col-xl-12 debug">
              <?php require('debug.php'); ?>
          </div>
      </div>
    </div>
    <!-- Sourcer les script JS -->
    <!-- Pour Bootstrapt :jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <!-- Script perso -->
    <!-- <script type="text/javascript" src="/web/static/javascript/toggleMenu.js"></script> -->
  </body>
</html>
