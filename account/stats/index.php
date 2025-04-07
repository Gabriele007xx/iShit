<?php
session_start();
require('../../config/config.php');
require('../../utils/functions.php');
if(!isset($_SESSION['id']))
{
    header('Location: ../login/index.php');
    exit();
}
$query="SELECT * FROM posts WHERE userID = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $_SESSION['id']);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($posts)
{
    $totalePosts = count($posts);
    $totaleMiPiace = 0;
    $postPiuVotato = 0;
    $caccaverde=0;
    $caccarossa=0;
    $caccamarrone=0;
    $galleggia=0;
    $nonGalleggia=0;
    foreach($posts as $post)
    {
        if($post['color'] == 'verde')
        {
            $caccaverde++;
        }
        elseif($post['color'] == 'rossa')
        {
            $caccarossa++;
        }
        elseif($post['color'] == 'marrone')
        {
            $caccamarrone++;
        }
        if($post['galleggio'] == "yes")
        {
            $galleggia++;
        }
        else
        {
            $nonGalleggia++;
        }
        $totaleMiPiace += $post['votes'];
        if($post['votes'] > $postPiuVotato)
        {
            $postPiuVotato = $post['votes'];
        }
    }
}
else
{
    $totalePosts = 0;
    $totaleMiPiace = 0;
    $postPiuVotato = 0;
    $caccaverde=0;
    $caccarossa=0;
    $caccamarrone=0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiche di merda - iShit</title>
    <link rel="stylesheet" href="../../style.css">

</head>
<body>
    <?php include('../../site/nav.php'); 
    navbar(2);
    ?>
    <main>
        <h3>Totale posts: <?php echo $totalePosts; ?></h3>
        <h3>Totale mi piace: <?php echo $totaleMiPiace; ?> </h3>
        <h3> Post piu' votato:<?php echo $postPiuVotato; ?> </h3>

    <section>
        <h3>Cacca per tipo</h3>
        <canvas id="pie-graph-color"></canvas>
    </section>

    <section>
        <h3>Galleggia o non galleggia?</h3>
        <canvas id="pie-graph-float"></canvas>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.8/dist/chart.umd.min.js"></script>
    <script>
        const dataColor = {
  labels: [
    'Marrone',
    'Rossa',
    'Verde'
  ],
  datasets: [{
    label: 'Cacca per colore',
    data: [<?php echo "$caccamarrone, $caccarossa, $caccaverde";?>],
    backgroundColor: [
      'rgb(71, 35, 6)',
      'rgb(83, 6, 6)',
      'rgb(25, 71, 13)'
    ],
    hoverOffset: 4
  }]
};

const dataFloat = {
  labels: [
    'Si',
    'No'
  ],
  datasets: [{
    label: 'Galleggia?',
    data: [<?php echo "$galleggia, $nonGalleggia";?>],
    backgroundColor: [
      'rgb(255, 255, 255)',
      'rgb(0, 0, 0)'
    ],
    hoverOffset: 4
  }]
};

const ctxColor = document.getElementById('pie-graph-color');

  new Chart(ctxColor, {
    type: 'pie',
    data: dataColor
  });

const ctxFloat = document.getElementById('pie-graph-float');

    new Chart(ctxFloat, {
        type: 'pie',
        data: dataFloat
    });
        </script>
    </main>
    <?php include ('../../site/footer.php'); ?>
</body>
</html>