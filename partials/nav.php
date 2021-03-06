<?php
/**
 * Created by IntelliJ IDEA.
 * User: gilbertor
 * Date: 6/29/15
 * Time: 5:21 PM
 */ ?>
<?php require_once("partials/header.php"); ?>
<?php require_once("config.php"); ?>
<?php
function keytime($period, $action)
{

    $c = count($period);
    for ($i = 1; $i <= $c; $i++) {
        ?>
        <li><a class="blue-text" target='_blank'
               href='viewv2.php?<?php echo $action; ?>=<?php echo $i; ?>'><?php echo $period[$i]['period_label']; ?></a>
        </li>
        <?php
        /*  echo "<tr>";
          echo "<td>{$period[$i]['period_label']}</td>";
          echo "<td>{$period[$i]['period_start_label']}</td>";
          echo "<td>{$period[$i]['period_end_label']}</td>";
          echo "<td><a   target='_blank'  href='view.php?period={$i}'> Side-by-Side</a></td>";
          echo "</tr>";*/
    }
}


?>

<nav>
    <div class="nav-wrapper blue">
        <div class="container">

            <img src="images/icon.png" class="icon"/>
            <a href="index.php" class="brand-logo icon-text-position"><span class="icon-text">Suite</span>View</a>


            <ul class="right">
                <li><a class="dropdown-button" data-activates="user-dropdown"><i
                            class="mdi-navigation-more-vert"></i></a></li>
            </ul>
            <ul class="right hide-on-med-and-down">
                <li class=""><a href="index.php" title="Home"><i class="mdi-action-home"></i></a></li>
                <li><a title="Bookmarks" class="dropdown-button" href="" data-activates="bookmark-dropdown"><i
                            class="fa fa-bookmark-o"></i></a></li>
                <li><a title="Filmstrip" class="dropdown-button" href="" data-activates="filmstrip-dropdown"><i
                            class="fa fa-film"></i></a></li>
            </ul>
            <ul id="user-dropdown" class="dropdown-content">
                <li><a href="" data-action="logout" class="blue-text"><i class="mdi-action-lock"></i> Sign Out</a></li>
                <li><a class="blue-text" href="">Sign in</a></li>
                <li><a class="blue-text" href="">Register</a></li>
                <li><a class="blue-text" href="about.php">About</a></li>
            </ul>
            <ul id="bookmark-dropdown" class="dropdown-content">
                <?php echo keytime($period, 'bookmark') ?>
            </ul>
            <ul id="filmstrip-dropdown" class="dropdown-content">
                <?php echo keytime($period, 'period') ?>
            </ul>
            <a class="button-collapse" href="#" data-activates="nav-mobile"><i class="mdi-navigation-menu"></i></a>
        </div>
    </div>
</nav>


<ul id="nav-mobile" class="side-nav">
    <li class="Bold"><a href="index.php" title="Home"><i class="mdi-action-home"> Home</i> </a></li>
    <li class="Bold"><a title="Bookmarks" class="dropdown-button" href="" data-activates="bookmark-dropdown"><i
                class="fa fa-bookmark-o"> Bookmarks</i></a></li>
    <li class="Bold"><a title="Side By Side" class="dropdown-button" href="" data-activates="filmstrip-dropdown"><i
                class="fa fa-film"> Side By Side</i></a></li>
    <li><a class="Bold" href="about.php" title="About"><i
                class="fa fa-info-circle"> About</i></a></li>
</ul>
<!--<h6 class="container">(in beta) version 0.13</h6>-->

</nav>

