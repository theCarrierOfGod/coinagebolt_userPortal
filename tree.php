<?php include_once('./header.php'); ?>
<title> Genealogy | Coinagebolt </title>

<style>
.tree, .tree ul, .tree li {
list-style: none;
margin: 0;
padding: 0;
position: relative;
}

.tree {
margin: 0 0 1em;
text-align: center;
}
.tree, .tree ul {
display: table;
}
.tree ul {
width: 100%;
}
.tree li {
display: table-cell;
padding: .5em 0;
vertical-align: top;
}
/* _________ */
.tree li:before {
outline: solid 1px #666;
content: "";
left: 0;
position: absolute;
right: 0;
top: 0;
}
.tree li:first-child:before {left: 50%;}
.tree li:last-child:before {right: 50%;}

.tree code, .tree span {
border: solid .1em #666;
border-radius: .2em;
display: inline-block;
margin: 0 .2em .5em;
padding: .2em .5em;
position: relative;
border-radius: 100%;
width: 85px;
height: 85px;
background-size: cover;
border: none;
}
.tree span span {
width: 50px;
height: 50px;
background-size: cover;
border: none;
}
/* If the tree represents DOM structure */
.tree code {
font-family: monaco, Consolas, 'Lucida Console', monospace;
}

/* | */
.tree ul:before,
.tree code:before,
.tree span:before {
outline: solid 1px #666;
content: "";
height: .5em;
left: 50%;
position: absolute;
}
.tree ul:before {
top: -.5em;
}
.tree code:before,
.tree span:before {
top: -.55em;
}

/* The root node doesn't connect upwards */
.tree > li {margin-top: 0;}
.tree > li:before,
.tree > li:after,
.tree > li > code:before,
.tree > li > span:before {
outline: none;
}
/*.fig {*/
/*    justify-content: center;*/
/*    display: flex;*/
/*}*/
</style>
    
    
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Genealogy</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item">
                                                <a href="/">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item active">Genealogy</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-xl-12 mt-3">
                                <div class="card" style="height: 100%; margin-bottom: 20px">
                                    <div class="card-body table-responsive">
                                        <figure class="fig table-responsive">
                                            <ul class="tree w-100">
                                                <li>
                                                    <span>
                                                        <span style="background-image: url('<?php echo $user->getDP($userOnline); ?>')"></span>
                                                        <p style="width: 75px">
                                                            <?php echo $userOnline; ?>
                                                        </p>
                                                    </span>
                                                    <ul>
                                                        <!-- level one downlines-->
                                                        <?php
                                                            if(!empty($levelOne->myDownlines($userOnline))) {
                                                                foreach($levelOne->myDownlines($userOnline) as $rec) {
                                                                    if($user->getDP($rec['username'])) {
                                                                        $dp = $user->getDP($rec['username']);
                                                                    }
                                                                    
                                                                    ?>
                                                                        <li>
                                                                            <span>
                                                                                <span style="background-image: url('<?php echo $dp; ?>')"></span>
                                                                                <p style="width: 75px">
                                                                                    <?php echo $rec['username']; ?>
                                                                                </p>
                                                                            </span>
                                                                            <ul>
                                                                                <!-- level two downlines-->
                                                                                <?php
                                                                                    if(!empty($levelTwo->levelTwoDown($rec['username']))) {
                                                                                        foreach($levelTwo->levelTwoDown($rec['username']) as $rec) {
                                                                                            if($user->getDP($rec['username'])) {
                                                                                                $dp = $user->getDP($rec['username']);
                                                                                            }
                                                                                            
                                                                                            ?>
                                                                                                <li>
                                                                                                    <span>
                                                                                                        <span style="background-image: url('<?php echo $dp; ?>')"></span>
                                                                                                        <p style="width: 75px">
                                                                                                            <?php echo $rec['username']; ?>
                                                                                                        </p>
                                                                                                    </span>
                                                                                                    <ul>
                                                                                                        <!-- level three downlines-->
                                                                                                        <?php
                                                                                                            if(!empty($levelTwo->levelTwoDown($rec['username']))) {
                                                                                                                foreach($levelTwo->levelTwoDown($rec['username']) as $rec) {
                                                                                                                    if($user->getDP($rec['username'])) {
                                                                                                                        $dp = $user->getDP($rec['username']);
                                                                                                                    }
                                                                                                                    
                                                                                                                    ?>
                                                                                                                        <li>
                                                                                                                            <span>
                                                                                                                                <span style="background-image: url('<?php echo $dp; ?>')"></span>
                                                                                                                                <p style="width: 75px">
                                                                                                                                    <?php echo $rec['username']; ?>
                                                                                                                                </p>
                                                                                                                            </span>
                                                                                                                            <ul>
                                                                                                                                <!-- level four downlines-->
                                                                                                                                <?php
                                                                                                                                    if(!empty($levelTwo->levelTwoDown($rec['username']))) {
                                                                                                                                        foreach($levelTwo->levelTwoDown($rec['username']) as $rec) {
                                                                                                                                            if($user->getDP($rec['username'])) {
                                                                                                                                                $dp = $user->getDP($rec['username']);
                                                                                                                                            }
                                                                                                                                            
                                                                                                                                            ?>
                                                                                                                                                <li>
                                                                                                                                                    <span>
                                                                                                                                                        <span style="background-image: url('<?php echo $dp; ?>')"></span>
                                                                                                                                                        <p style="width: 75px">
                                                                                                                                                            <?php echo $rec['username']; ?>
                                                                                                                                                        </p>
                                                                                                                                                    </span>
                                                                                                                                                    <ul>
                                                                                                                                                        <!-- level five downlines-->
                                                                                                                                                        <?php
                                                                                                                                                            if(!empty($levelTwo->levelTwoDown($rec['username']))) {
                                                                                                                                                                foreach($levelTwo->levelTwoDown($rec['username']) as $rec) {
                                                                                                                                                                    if($user->getDP($rec['username'])) {
                                                                                                                                                                        $dp = $user->getDP($rec['username']);
                                                                                                                                                                    }
                                                                                                                                                                    
                                                                                                                                                                    ?>
                                                                                                                                                                        <li>
                                                                                                                                                                            <span>
                                                                                                                                                                                <span style="background-image: url('<?php echo $dp; ?>')"></span>
                                                                                                                                                                                <p>
                                                                                                                                                                                    <?php echo $rec['username']; ?>
                                                                                                                                                                                </p>
                                                                                                                                                                            </span>
                                                                                                                                                                            <ul>
                                                                                                                                                                                <!-- level six downlines-->
                                                                                                                                                                                <?php
                                                                                                                                                                                    if(!empty($levelTwo->levelTwoDown($rec['username']))) {
                                                                                                                                                                                        foreach($levelTwo->levelTwoDown($rec['username']) as $rec) {
                                                                                                                                                                                            if($user->getDP($rec['username'])) {
                                                                                                                                                                                                $dp = $user->getDP($rec['username']);
                                                                                                                                                                                            }
                                                                                                                                                                                            
                                                                                                                                                                                            ?>
                                                                                                                                                                                                <li>
                                                                                                                                                                                                    <span>
                                                                                                                                                                                                        <span style="background-image: url('<?php echo $dp; ?>')"></span>
                                                                                                                                                                                                        <p>
                                                                                                                                                                                                            <?php echo $rec['username']; ?>
                                                                                                                                                                                                        </p>
                                                                                                                                                                                                    </span>
                                                                                                                                                                                                </li>
                                                                                                                                                                                            <?php
                                                                                                                                                                                        }
                                                                                                                                                                                    }
                                                                                                                                                                                ?>
                                                                                                                                                                            </ul>
                                                                                                                                                                        </li>
                                                                                                                                                                    <?php
                                                                                                                                                                }
                                                                                                                                                            }
                                                                                                                                                        ?>
                                                                                                                                                    </ul>
                                                                                                                                                </li>
                                                                                                                                            <?php
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                ?>
                                                                                                                            </ul>
                                                                                                                        </li>
                                                                                                                    <?php
                                                                                                                }
                                                                                                            }
                                                                                                        ?>
                                                                                                    </ul>
                                                                                                </li>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            </ul>
                                                                        </li>
                                                                    <?php
                                                                }
                                                            }
                                                        ?>
                                                    </ul>
                                                </li>
                                                
                                            </ul>
                                        </figure>
 <!--                                       figure -->
 <!--figcaption Example sitemap-->
 <!--ul(class='tree')-->
 <!-- li-->
 <!--  span Home-->
 <!--  ul-->
 <!--   li-->
 <!--    span -->
 <!--    ul-->
 <!--     li-->
 <!--      span Our history-->
 <!--      ul-->
 <!--       li-->
 <!--        span Founder-->
 <!--     li-->
 <!--      span Our board-->
 <!--   li-->
 <!--    span Our products-->
 <!--    ul-->
 <!--     li-->
 <!--      span The Widget 2000™-->
 <!--      ul-->
 <!--       li-->
 <!--        span Order form-->
                                    </div><!-- end card-body-->
                                </div> <!-- end card-->
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->


                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

        <?php include('./footer.php'); ?>

