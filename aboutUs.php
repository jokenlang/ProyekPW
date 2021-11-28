<?php
if (isset($_POST['login'])) {
    // echo("test");
    header('Location:login.php');
    // http_redirect('login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <?php include('header.php'); ?>
    <div class="kiri">
        <div class="kontainer">
            <ul class="hyperlink">
                <!-- <li>About Us</li> -->
                <a href="#aboutus"><li>About Us</li></a>
                <a href="#plan"><li>Future Plan</li></a>
            </ul>
        </div>
    </div>
    <div class="tengah">
        <div id="aboutus">
            <h1 class="judul">About Us</h1>
            <p>Authentical was funded by my own wallet in 2021 and came to life as a project. Today, it’s a stupid website thst don't do anything else than scam you, your money and conquer all over the world with monopoly. We may have come a long way since our humble beginnings, but our vision remains the same: to create a better everyday life for the many people. Explore the Authentical story <a href="https://www.youtube.com/watch?v=d1YBv2mWll0" class="awuwu">not here</a>, to learn more about our heritage, what drives us today and the ways we seek to positively impact our mark and grade.</p>
            <br><br>
            <p>Further more I would like to ask you for financial help, and ofcourse help for my grade and mark so I can pass this stupid class. That usually usefull but since the lecturer sucks so this lecture rendered useless.</p>
            <br><br>
            <p>If you take anything from this website personally then it's your and your butt fault, why the heck you soft as fuck. I write this about Us page for the meme and for the fun if you read this far then you may or may not click this <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">click me senpai</a>, well if you not click it then okay, i'm not blaming you.</p>
            <br><br>
            <p>Please condiser to help us financially by donating <a href="https://www.youtube.com/watch?v=d1YBv2mWll0">here</a>, thank you if you decide to help us by donating, then our employee have to battle royale to earn themselves chicken dinner</p>
            <br><br>
        </div>
        <div id="plan">
            <h1 class="rencana">Future Plan</h1>
            <p>In the future we will improe our skill to write our code and give you the best way to earn free grade and mark. So every people in the entire earth can easily pass every exam easily because our aid in making the perfect room to study.</p>
            <br><br>
            <p>in order to achiev that we hope that our product can be reach everywhere, anytime needed. And also our hope is to make sure that customer have their expectation match with reality so our display on website will be refine to the highest quality without any 3rd party program that color correct, sharpen the image, etc. </p>
        </div>
    </div>
    <div class="kanan"></div>
    <div class="cb"></div>
    <?php include('footer.php'); ?>
</body>
</html>