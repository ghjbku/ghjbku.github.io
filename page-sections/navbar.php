<?php 
/**
 * A menü felépítése. Ez a fájl kívülről nem érhető el.
 */
if(basename($_SERVER['SCRIPT_FILENAME']) != 'index.php') die();?>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg fixed-top" style="background: #16181a">
                <a class="navbar-brand" href="index.html"><img width='150px' src="assets/images/logo.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
               <div class="navbar-nav ml-auto navbar-right-top" style='padding-right: 20px'>Szia, <?=User::getUserData()->displayName?>!</div>
            </nav>
        </div>
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column"> 
                            <li class="nav-divider">
                                Menü
                            </li>
                            <?php foreach(Config::get('page/menu') as $item) {
                                if($item['link'] == $currPage) { ?>        
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?=$item['link']?>"><?=isset($item['icon']) && $item['icon'] != '' ? '<i class="'.$item['icon'].'"></i>' : '' ?><?=$item['name']?></a>
                                </li>
                           <?php } else { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=$item['link']?>"><?=isset($item['icon']) && $item['icon'] != '' ? '<i class="'.$item['icon'].'"></i>' : '' ?><?=$item['name']?></a>
                                </li>
                           <?php }} ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
