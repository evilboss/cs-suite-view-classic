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
function keytime($period)
{

    $c = count($period);
    for ($i = 1; $i <= $c; $i++) {
        ?>
        <li><a class="blue-text" target='_blank' href='viewv2.php?period=<?php echo $i;?>'><?php echo $period[$i]['period_label']; ?></a></li>
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
            <a class="brand-logo" href="index.php">Cloudstaff Suite View</a>

            <ul class="right">
                <li><a class="dropdown-button" href="index.php" data-activates="user-dropdown"><i
                            class="mdi-navigation-more-vert"></i></a></li>
            </ul>

            <ul class="right hide-on-med-and-down">
                <li class=""><a href="index.php" title="Home"><i class="mdi-action-home"></i></a></li>
                <li class=""><a href="index.php" title="Dashboard"><i class="mdi-action-dashboard"></i></a></li>
                <li><a title="Bookmarks" class="dropdown-button" href="index.php" data-activates="bookmark-dropdown"><i
                            class="fa fa-bookmark-o"></i></a></li>
            </ul>

            <ul id="user-dropdown" class="dropdown-content">

                <li><a href="" data-action="logout" class="blue-text"><i class="mdi-action-lock"></i> Sign Out</a></li>

                <li><a class="blue-text" href="">Sign in</a></li>
                <li><a class="blue-text" href="">Register</a></li>

            </ul>
            <ul id="bookmark-dropdown" class="dropdown-content">

               <?php echo keytime($period)?>

            </ul>

            <a class="button-collapse" href="#" data-activates="nav-mobile"><i class="mdi-navigation-menu"></i></a>
        </div>
    </div>
</nav>


<ul id="nav-mobile" class="side-nav">
    <li class="bold {{ isActiveRoute regex='home' }}"><a href="" title="Home"><i class="mdi-action-home"></i> Home</a>
    </li>
    <li class="bold {{ isActiveRoute regex='dashboard' }}"><a href="{{ pathFor 'dashboard' }}" title="Dashboard"><i
                class="mdi-action-dashboard"></i> Dashboard</a></li>
</ul>
<h6 class="container">(in beta) version 0.13</h6>

</nav>
